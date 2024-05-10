// window.onscroll = function () { scrollFunction() };

// function scrollFunction() {
//   if ( document.body.scrollTop > 50 || document.documentElement.scrollTop > 50 ) {
    
//     document.getElementById("header" ).style.fontSize = "25px";
//     document.getElementById("header").style.height="75px";
//   } else {
//     document.getElementById( "header" ).style.fontSize = "50px";
//     document.getElementById("header").style.height="125px";

//   }
// }
function showCreateDB(){
  document.getElementById("createDB").style.display="block";
  document.getElementById("createTable").style.display="none";
  document.getElementById("readTable").style.display="none";
  document.getElementById("updateTable").style.display="none";
  document.getElementById("deleteTable").style.display="none";
}

function showCreateTable(){
  document.getElementById("createDB").style.display="none";
  document.getElementById("createTable").style.display="block";
  document.getElementById("readTable").style.display="none";
  document.getElementById("updateTable").style.display="none";
  document.getElementById("deleteTable").style.display="none";
}

function showReadTable(){
  document.getElementById("createDB").style.display="none";
  document.getElementById("createTable").style.display="none";
  document.getElementById("readTable").style.display="block";
  document.getElementById("updateTable").style.display="none";
  document.getElementById("deleteTable").style.display="none";
}

function showUpdateTable(){
  document.getElementById("createDB").style.display="none";
  document.getElementById("createTable").style.display="none";
  document.getElementById("readTable").style.display="none";
  document.getElementById("updateTable").style.display="block";
  document.getElementById("deleteTable").style.display="none";
}

function showDeleteTable(){
  document.getElementById("createDB").style.display="none";
  document.getElementById("createTable").style.display="none";
  document.getElementById("readTable").style.display="none";
  document.getElementById("updateTable").style.display="none";
  document.getElementById("deleteTable").style.display="block";
}
