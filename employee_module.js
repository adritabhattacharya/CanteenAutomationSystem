var completedButtons=document.getElementsByClassName("c")
for(var i=0;i<completedButtons.length;i++){
    var button=completedButtons[i];
    button.addEventListener('click',deletefromScreen);
}
function deletefromScreen(event){
    var buttonClicked=event.target
    buttonClicked.parentElement.parentElement.remove();
}