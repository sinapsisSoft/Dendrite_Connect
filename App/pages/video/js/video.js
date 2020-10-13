//************ LOAD VIEW ******************/
function loadView() {  
  loadPageView();
  getActionStorage();
  nobackbutton();    
  setListener();
  enableScroll();
  setTimeout(function(){
    getVideos()
  }, 1000);
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
  enableButton(0, bodyId);
  setDataVideo(setData(bodyId));  
}

//**Function save video watched **/
function setDataVideo(dataSetVideo) {
  try {
    loadPageView();
    dataSetVideo = '{"POST":"POST",' + dataSetVideo + '}';
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../../php/bo/bo_video.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        if (xhttp.responseText == 1) {      
          loadView();    
          enableScroll();
        }
      }
    }
    xhttp.send(dataSetVideo);
  } catch (error) {
    console.error(error);
  }
}

//**Function get videos watched **/
function getDataVideo(dataSetUser, typeSend) {
  try {
    loadPageView();
    var xhttp = new XMLHttpRequest();
    var JsonData;
    xhttp.open("POST", "../../php/bo/bo_video.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        var jsonObj = JSON.parse(xhttp.responseText);
        if (jsonObj.length != 0) {          
          if (typeSend == 0) {
            disableVideo(jsonObj);
            enableScroll();
          }
          if (typeSend == 1) {
            setScore(jsonObj)
            enableScroll();
          }
        }
      }
    };
    if (typeSend == 0) {
      JsonData = '{"GET":"GET","User_id":"' + dataSetUser + '"}';
    }
    if (typeSend == 1) {
      JsonData = '{"GET":"GET_SCORE","User_id":"' + dataSetUser + '"}';
    }
    xhttp.send(JsonData);
  } catch (error) {
    console.error(error);
    enableScroll();
  }
}

//**Function to create de Json to send**/
function setData(video){  
  data = '"Video_name":"' +video+'","Video_watched":"' +1+ '","User_id":"' + getUserId() + '"';
  return data;
}

//Get all videos watched
function getVideos(){
  getDataVideo(getUserId(),0);
  getDataVideo(getUserId(),1);
}

function disableVideo(json){
  for(i = 0; i < json.length; i++){
    videoDisable = document.getElementById(json[i]["Video_name"]);
    disabledCard(videoDisable);
    enableButton(0,json[i]["Video_name"]);
  }
}

function disabledCard(id){
  id.controls = false;
}

function getUserId(){
  return document.getElementById("User_id").value;
}

function enableButton(type, bodyId){  
  let body = "bodyModal"+bodyId;
  let button = "button"+bodyId;  
  if(type == 0){
    document.getElementById(button).disabled = false;
    document.getElementById(body).classList.remove("answerHidde");
    document.getElementById(body).classList.add("answerVisible");  
  }
  else if (type == 1){
    document.getElementById(button).disabled = true;
    document.getElementById(body).classList.remove("answerVisible"); 
    document.getElementById(body).classList.add("answerHidde");     
  }  
}

function setScore(json){
  for (let key in json[0]) {   
    document.getElementById(key).innerHTML = json[0][key];
  }
}