var ul = document.getElementById('todos');
var li, count = 1, checkingDuplication;

var addButton = document.getElementById('add');
addButton.addEventListener('click', addItem);

var removeButton = document.getElementById('remove');
removeButton.addEventListener('click', removeItem);

var removeAllButton = document.getElementById('removeAll');
removeAllButton.addEventListener('click', removeAllItem);

ul.addEventListener('dblclick', function(event) {
  if (event.target.tagName === 'LABEL') {
    editItem(event.target);
  }
});

// function addItem(){
//   var input = document.getElementById('input')
//   var item = input.value
//   ul = document.getElementById('todos')
//   var textNode = document.createTextNode(item)
//   var reWhiteSpace = /^\s+$/

//   if(item === '' || reWhiteSpace.test(item)){
//       const myPara = document.createElement('p')
//       myPara.textContent = 'Please Enter your TODO!'
//       document.querySelector('form').appendChild(myPara)
//       setTimeout(() => {
//           myPara.textContent = ''
//       }, 5500)
//       input.value = ''
//   }
//   else if(item === checkingDuplication) {
//       const duplicate = document.createElement('p')
//       duplicate.textContent = 'Already Present In Your List!'
//       document.querySelector('form').appendChild(duplicate)
//       setTimeout(() => {
//           duplicate.textContent = ''
//       }, 5500)
//       input.value = ''
//   }
//   else {
//       li = document.createElement('li')
//       var checkbox = document.createElement('input')
//       checkbox.type = 'checkbox'
//       checkbox.setAttribute('id', count)
//       var label = document.createElement('label')
//       label.htmlFor = count
//       ul.appendChild(label)
//       li.appendChild(checkbox)
//       label.appendChild(textNode)
//       li.appendChild(label)
//       ul.insertBefore(li, ul.childNodes[0])
//       setTimeout(() => {
//           li.className = 'visual'
//       }, 2)
//       checkingDuplication = item
//       input.value = ''
//       count++
//   }  
  
// }
// function removeItem(){
//   li = ul.children
//   for(let i=0; i<li.length; i++){
//        while(li[i] && li[i].children[0].checked){
//            ul.removeChild(li[i])
// }
//   }
//   checkingDuplication = ''
// }

function addItem() {
    var input = document.getElementById('input');
    var item = input.value;
  
    if (item.trim() === '') {
      alert('Please enter your TODO!');
      return;
    }
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_todo.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            var itemId = response.itemId;
            addItemToUI(itemId, item);
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
  
  function addItemToUI(itemId, item) {
    var ul = document.getElementById('todos');
    var li = document.createElement('li');
    var checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.setAttribute('id', 'check' + itemId);
    var label = document.createElement('label');
    label.htmlFor = 'check' + itemId;
    label.textContent = item;
  
    li.appendChild(checkbox);
    li.appendChild(label);
    ul.appendChild(li); // Use appendChild instead of insertBefore
    setTimeout(function() {
      li.className = 'myCheck'; // Update the class name for proper styling
    }, 2);
  }
  


// Fetch initial items from the database and display them in the UI
var xhr = new XMLHttpRequest();
xhr.open('GET', 'fetch_todos.php', true);
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            var todos = response.todos;
            todos.forEach(function(todo) {
                addItemToUI(todo.id, todo.item);
            });
        } else {
            alert(response.message);
        }
    }
};
xhr.send();


function removeItem() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  
    // Send AJAX requests to remove the selected items
    checkboxes.forEach(function(checkbox) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'remove_todo.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Item removed successfully, update the UI
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
      xhr.send('id=' + checkbox.id.replace('check', ''));
    });
  }
  





// function removeAllItem(){
//   while(ul.hasChildNodes()){
//       ul.removeChild(ul.firstChild)
//   }
//   checkingDuplication = ''
// }



function removeAllItem() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'remove_all_todos.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.success) {
        // Remove all items from the UI
        ul.innerHTML = '';
      } else {
        alert(response.message);
      }
    }
  };
  xhr.send();
}



function editItem(label) {
  label.contentEditable = true; // Enable editing of label text
  label.focus();
  label.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      label.contentEditable = false; // Disable editing of label text
    }
  });
}
