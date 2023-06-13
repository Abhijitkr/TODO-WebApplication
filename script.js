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

function addItem() {
  // ...
}

function removeItem() {
  // ...
}

function removeAllItem() {
  // ...
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
