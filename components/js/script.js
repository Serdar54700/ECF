function Check(value, idClient) {
    let bg = value.checked
    let test = document.querySelector("#test"+idClient); 
    // test.style.classList.add = "ouiactive"
    
 

    // event.preventDefault();
    const data = new FormData();
    data.append('check', bg);
    data.append('id', idClient);
    if (bg == false) {
        test.classList.remove("ouiactive")
    } else {
        test.classList.add("ouiactive")
  
    }
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', './components/back/envoi.php');
    // requeteAjax.onload = function() {
    // }
    requeteAjax.send(data);


};



let btn = document.querySelectorAll('.btnfct');
let fenetre = document.querySelectorAll('.bgla');

for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', () => {

        fenetre[i].classList.toggle('bgla')
    });

}



let searchInput = document.getElementById('searchDropdown');

searchInput.addEventListener('keyup', () => {
    let searchQuery = event.target.value.toLowerCase();
    let allNamesDOMCollection = document.getElementsByClassName('name')
    for (let i = 0; i < allNamesDOMCollection.length; i++) {
        const currentName = allNamesDOMCollection[i].textContent.toLowerCase();
        if (currentName.includes(searchQuery)) {
            allNamesDOMCollection[i].parentElement.style.display = 'block';
        } else {
            allNamesDOMCollection[i].parentElement.style.display = 'none';
        }
    }
})



function CheckStructure(value, idClient) {
    let bg = value.checked

    // event.preventDefault();
    const data = new FormData();
    data.append('check', bg);
    data.append('id', idClient);

    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', './components/back/changeStructure.php');
    // requeteAjax.onload = function() {
    // }
    requeteAjax.send(data);


};