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
  video = document.getElementById("video1");
  video.addEventListener("ended", lero); 
  //setListener();
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
    debugger;
    //video[i].addEventListener("ended", viewModal("exampleModal",0), false); 
    console.log(video[i].duration);
    video[i].addEventListener("ended", lero(video[i].id,0), false); 
  }   
}

function lero(){
    alert("video");
}
