var ul = document.getElementById('todos')
var li


var addButton = document.getElementById('add')
addButton.addEventListener('click', addItem)

var removeButton = document.getElementById('remove')
removeButton.addEventListener('click', removeItem)

var removeAllButton = document.getElementById('removeAll')
removeAllButton.addEventListener('click', removeAllItem)

function addItem(){
    var input = document.getElementById('input')
    var item = input.value
    ul = document.getElementById('todos')
    var textNode = document.createTextNode(item)
    var reWhiteSpace = /^\s+$/
    if(item === '' || reWhiteSpace.test(item)){
        const myPara = document.createElement('p')
        myPara.textContent = 'Please Enter your TODO!'
        document.querySelector('form').appendChild(myPara)
        setTimeout(() => {
            myPara.textContent = ''
        }, 5500)
        input.value = ''
    }
    else {
        li = document.createElement('li')
        var checkbox = document.createElement('input')
        checkbox.type = 'checkbox'
        // checkbox.setAttribute('id', 'check')
        var label = document.createElement('label')
        ul.appendChild(label)
        li.appendChild(checkbox)
        label.appendChild(textNode)
        li.appendChild(label)
        ul.insertBefore(li, ul.childNodes[0])
        setTimeout(() => {
            li.className = 'visual'
        }, 2)
        input.value = ''
    }  

}
function removeItem(){
    li = ul.children
    for(let i=0; i<li.length; i++){
         while(li[i] && li[i].children[0].checked){
             ul.removeChild(li[i])
}
    }
    
}

function removeAllItem(){
    while(ul.hasChildNodes()){
        ul.removeChild(ul.firstChild)
    }
}