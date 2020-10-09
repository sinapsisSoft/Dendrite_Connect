Object.defineProperty(HTMLMediaElement.prototype, 'stoped',
  {
    get: function () {
      return !!(this.paused && this.readyState > 2);
    }
  }); 
//************ LOAD VIEW ******************/
function loadView() {
  loadPageView();
  getActionStorage();
  nobackbutton();    
  setListener();
}

//************SEARCH PROVIDER**************//

function locationPage(){
    setTimeout(function () {
        window.location.assign("dashboard.php");
    }, 1200);
}
//************CLOSE**************//
function closeSession(){
    let obj=new StoragePage();
    obj.removeStorageUser();
    window.location.assign("../login/login.html");

}

//************ LOAD VIEW STORAGE ******************/
function getActionStorage() {
  let obj=new StoragePage();
  let json=JSON.parse(obj.getStorageLogin());0
  if (json !== null) {
  getDataUserId(json[0]["User_id"]);
  }else{
      locationLogin();
  }
}

//************ VIDEO STATUS ******************/
function setListener(){    
  var video = document.querySelectorAll('video');
  for(i = 0; i < video.length; i++){
    video[i].addEventListener("ended", activeModal, false); 
  }   
}

function activeModal(){
  viewModal(this.id+"Modal", 0);
  let modalId = this.id;  
  setTimeout(function(){showAnswer(modalId)},3000);
}

function showAnswer(bodyId){
  let body = "bodyModal"+bodyId;
  let button = "button"+bodyId;
  document.getElementById(body).classList.remove("answerHidde");
  document.getElementById(body).classList.add("answerVisible");
  document.getElementById(button).disabled = false;
}