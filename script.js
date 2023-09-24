var ul = document.getElementById('todos');
var todos = new Set(); // Collection to store added todos

var addButton = document.getElementById('add');
addButton.addEventListener('click', addItem);

var removeButton = document.getElementById('remove');
removeButton.addEventListener('click', removeItem);

var removeAllButton = document.getElementById('removeAll');
removeAllButton.addEventListener('click', removeAllItem);

ul.addEventListener('dblclick', function (event) {
  if (event.target.tagName === 'LABEL') {
    editItem(event.target);
  }
});

function addItem(e) {
  e.preventDefault();
  var input = document.getElementById('input');
  var item = input.value.trim();

  if (item === '') {
    alert('Please enter your TODO!');
    return;
  }

  // Check if the todo already exists
  if (todos.has(item)) {
    alert('The TODO already exists!');
    return;
  }

  todos.add(item); // Add the new todo to the collection
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_todo.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          var itemId = response.itemId;
          addItemToUI(itemId, item, '0'); // Pass '0' for unchecked todo
        } else {
          alert(response.message);
        }
      } else {
        alert('An error occurred while adding the todo.');
      }
    }
  };
  xhr.send('item=' + encodeURIComponent(item));

  input.value = '';
}



function removeItem() {
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

  if (checkboxes.length === 0) {
    alert('No todos selected to remove.');
    return;
  }

  checkboxes.forEach(function (checkbox) {
    var itemId = checkbox.id.replace('check', '');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'remove_todo.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Remove the item from the UI
          var li = checkbox.parentNode;
          li.parentNode.removeChild(li);
        } else {
          // Handle the error if item removal failed
          alert(response.message);
        }
      }
    };
    xhr.send('id=' + encodeURIComponent(itemId));
  });
}



function removeAllItem() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'remove_all_todos.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          ul.innerHTML = '';
        } else {
          alert(response.message);
        }
      } else {
        alert('An error occurred while removing all todos.');
      }
    }
  };
  xhr.send();
}

function editItem(label) {
  var newText = prompt('Enter the new text for this todo:', label.textContent);

  if (newText !== null) {
    var itemId = label.getAttribute('for').replace('check', '');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'edit_todo.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            label.textContent = newText;
          } else {
            alert(response.message);
          }
        } else {
          alert('An error occurred while updating the todo.');
        }
      }
    };
    xhr.send('id=' + encodeURIComponent(itemId) + '&newText=' + encodeURIComponent(newText));
  }
}


// Fetch todos from the database and add them to the UI on page load
window.addEventListener('load', function () {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'fetch_todos.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          var todos = response.todos;
          for (var i = 0; i < todos.length; i++) {
            var todo = todos[i];
            addItemToUI(todo.id, todo.item, todo.checked);
          }
        } else {
          alert(response.message);
        }
      } else {
        alert('An error occurred while fetching the todos.');
      }
    }
  };
  xhr.send();
});

function addItemToUI(itemId, item, checked) {
  var li = document.createElement('li');
  var checkbox = document.createElement('input');
  checkbox.type = 'checkbox';
  checkbox.setAttribute('id', 'check' + itemId);
  checkbox.setAttribute('value', '1');
  checkbox.addEventListener('change', updateDatabase);
  var label = document.createElement('label');
  label.htmlFor = 'check' + itemId;
  label.textContent = item;

  // Check if the todo should be marked as checked
  if (checked === 1) {
    checkbox.checked = true;
    li.classList.add('myCheck');
  }

  li.appendChild(checkbox);
  li.appendChild(label);
  ul.appendChild(li);

  // Apply animation to the newly added
  li.classList.add('animation');
}

function updateDatabase(event) {
  var checkbox = event.target;
  var isChecked = checkbox.checked ? 1 : 0;
  var itemId = checkbox.id.replace('check', '');
  var text = checkbox.nextElementSibling.textContent;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'update_todo.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (!response.success) {
        alert('An error occurred while updating the todo.');
      }
    }
  };
  xhr.send('id=' + itemId + '&checked=' + isChecked + '&text=' + encodeURIComponent(text));
}