let AllPlayersLis = []
let IdCArdPlaterSelected = -1 ;
let TargetINdexPanel = 1 ;
function Display_All_Players(){
  let routedata ="" ; 

  TargetINdexPanel==1 && (routedata = 'players');
  TargetINdexPanel==2 && (routedata = 'clubs');
  TargetINdexPanel==3 && (routedata = 'nationnalitys');
  document.getElementById("playerslist").innerHTML = `
  <div class="w-[100%] flex justify-center items-center">
     <div class="px-3 py-1 h-5 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">loading...</div>
  </div>               
  `;
  console.log(`http://localhost:8582/${routedata}`)
    fetch(`http://localhost:8582/${routedata}`,{
      method : 'GET'
    })
    .then(res=>res.json())
    .then(data=> {
      setTimeout(() => {
        AddPlaperPanel(data , TargetINdexPanel);
        AllPlayersLis = data;
      }, 500);
    })
}

function AddPlaperPanel(data , pos){
    let PlayerCards = ``;
    if(pos == 1){
      data && data.forEach((item , i)=>{
              PlayerCards += `
                
          <div class="flip-card" onclick='OpenFormPanel(0,${item.id})' >
           
              <div class="flip-card-inner">
              
                   <div class=' flip-card-front relative shadow-md cursor-pointer''>
                        <img src="${item.cover ?? './Assets/badge-white.png'}" 
                        class="w-36" alt="">
                        
                        <div class="absolute left-[25px] top-[40px] flex flex-col items-center">
                            <h2 class="m-0 p-0 font-bold text-ms text-[#FFD972] ">${Math.floor((item.pace + item.shooting + item.physical + item.passing + item.defending + item.dribbling + item.dribbling)/7) }</h2>
                            <span class="text-[8px] font-bold ${item.rating>85 && (item.position != "GK" &&'text-[#FFD972]')}">${item.position}</span>
                            <img class="w-5 ${item.rating>85 &&(item.position != "GK" &&'text-[#FFD972]')}" src="${item.flag}"  alt="" />
                        </div>
                        <img class="absolute right-4 w-24 top-6" src="${item.photo}" alt="" />
                        <div class="absolute left-8 right-8 top-32 font-bold text-xs flex justify-center items-center text-center">
                            <h2 class="${item.rating>85 && (item.position != "GK" &&'text-[#FFD972]')} ">${item.name}</h2>
                        </div>
                        
                    </div>
                    <div class="absolute  flip-card-back top-0  h-full w-full   cursor-pointer ">
                      <div class="relative">
                          <svg class="" viewBox="0 0 252 346" fill="#181717" xmlns="http://www.w3.org/2000/svg">
                              <path d="M175.972 310.77C175.972 310.77 135.032 306.807 126.287 329C120.723 310.77 90.5147 311.166 82.5652 310.77C74.6157 310.374 21.7516 314.733 22.5465 283.029C20.9567 265.592 23.3414 71.4042 23.3414 67.4412C45.9975 64.6671 71.4359 43.2668 83.7576 40.4927C96.0793 37.7186 100.452 37.7186 100.452 37.7186C100.452 37.7186 104.029 45.6446 111.978 45.6446C119.928 45.6446 126.287 29 126.287 29C126.287 29 134.237 45.2483 141.789 45.6446C149.341 46.041 151.726 37.7186 151.726 37.7186C151.726 37.7186 162.06 37.7186 171.6 40.4927C181.139 43.2668 203.795 62.2893 229.631 69.0264C229.631 72.5931 229.234 225.962 229.631 283.029C235.196 310.77 175.972 310.77 175.972 310.77Z" stroke="#A2A2A2" stroke-width="2"/>
                              <defs>
                              <linearGradient id="paint0_linear_11_3" x1="28.2759" y1="71.4528" x2="234.72" y2="288.345" gradientUnits="userSpaceOnUse">
                              <stop stop-color="#2B2B2B"/>
                              <stop offset="1"/>
                              </linearGradient>
                              </defs>
                            </svg>
                                <div class="absolute top-8 text-[8px] text-white flex justify-center gap-4 w-full  p-1">
                                      <div class="flex flex-col gap-1">
       
                                          <p class="grid grid-cols-[1fr]">
                                              <span>Rating : </span> 
                                              <span class="border-[2px] text-xs rounded-full
                                                   border-${item?.rating>=90 ? 'green-400' : item?.item>=60 ?'yellow-400' : 'red-400' } 
                                                px-[2px] py-[2px]">${Math.floor((item.pace + item.shooting + item.physical + item.passing + item.defending + item.dribbling + item.dribbling)/7) }</span>
                                          </p>
                                           <p class="grid grid-cols-[1fr]">
                                              <span>Pace : </span> 
                                              <span class="border-[2px] rounded-full 
                                                  border-${(item?.pace ?? item.diving)>=90 ? 'green-400' : (item?.pace ?? item.diving)>=60 ?'yellow-400' : 'red-400' }
                                               px-[2px] py-[2px]">${item?.pace ?? item.diving}</span>
                                          </p>
                                          <p class="grid grid-cols-[1fr]">
                                              <span>Shooting : </span> 
                                              <span class="border-[2px] rounded-full 
                                                  border-${(item?.shooting ?? item.handling)>=90 ? 'green-400' : (item?.shooting ?? item.handling)>=60 ?'yellow-400' : 'red-400' }
                                               px-[2px] py-[2px]">${item?.shooting ?? item.handling}</span>
                                          </p>
                                          <p class="grid grid-cols-[1fr]">
                                              <span>Physical : </span> 
                                              <span class="border-[2px] rounded-full 
                                                  border-${(item?.physical ?? item.kicking)>=90 ? 'green-400' : (item?.physical ?? item.kicking)>=60 ?'yellow-400' : 'red-400' }
                                               px-[2px] py-[2px]">${item?.physical ?? item.kicking}</span>
                                          </p>
                                      </div>
                                      <div class="flex flex-col gap-1">
                                     
                                          <p class="grid grid-cols-[1fr]">
                                              <span>Passing : </span> 
                                              <span class="border-[2px] rounded-full 
                                               border-${(item?.passing ?? item.reflexes)>=90 ? 'green-400' : (item?.passing ?? item.reflexes)>=60 ?'yellow-400' : 'red-400' }
                                               px-[2px] py-[2px]">${item?.passing ?? item.reflexes}</span>
                                          </p>
                                          <p class="grid grid-cols-[1fr]">
                                               <span>Dribbling : </span> 
                                              <span class="border-[2px] rounded-full 
                                                  border-${(item?.defending ?? item.positioning)>=90 ? 'green-400' : (item?.defending ?? item.positioning)>=60 ?'yellow-400' : 'red-400' }
                                              px-[2px] py-[2px]">${item?.dribbling ?? item.speed}</span>
                                          </p>
                                          <p class="grid grid-cols-[1fr]">
                                              <span>Defending : </span> 
                                              <span class="border-[2px] rounded-full gap-2
                                                  border-${(item?.dribbling ?? item.speed)>=90 ? 'green-400' : (item?.dribbling ?? item.speed)>=60 ?'yellow-400' : 'red-400' }
                                                px-[2px] py-[2px]">${item?.defending ?? item.positioning}</span>
                                          </p>
                                         
                                      </div>
                                      
                                  </div>
                      </div>
                      
        
                    </div>
                </div>
          </div>  
  
              ` 
      })
      document.getElementById("playerslist").innerHTML = `
          <div id="datalistplayers" class="h-[70vh] overflow-y-auto " >
                  <div class="flex flex-wrap justify-center gap-1">
                  ${PlayerCards.length>0 ? PlayerCards : `
                  <div class="flex gap-2 ite px-5 py-2 w-full mt-10 border-2 border-gray-700 text-gray-200">
                  Empty data players</span>
                  </div>`}
                  </div>
          </div>
      `;
    }
    else if(pos == 2){
      document.getElementById("playerslist").innerHTML =``;
      let ClubsCards = ''
      data && data.forEach((item , i)=>{
        ClubsCards += `
            <div id='club${item.club_id}' onclick='PickClub(${item.club_id})' class='cursor-pointer text-white flex flex-col gap-4 px-2 py-3 rounded-md items-center bg-[#101744] hover:bg-[#1d2660]' >
              <img class='h-16' src='${item.club_img}' alt='' />
              <span>${item.club_name}</span>
            </div>
        ` ;
        })
    document.getElementById("playerslist").innerHTML = `
        <div id="clubsplayers" class="h-[69vh] overflow-y-auto py-5" >
                <div class="flex flex-wrap justify-center gap-1">
                ${ClubsCards.length>0 ? ClubsCards : `
                <div class="flex gap-2 ite px-5 py-2 w-full mt-10 border-2 border-gray-700 text-gray-200">
                Empty data </span>
                </div>`}
                </div>
        </div>
    `;
    }
    else {
      document.getElementById("playerslist").innerHTML =``;
      let NationnalitysCards = ''
      data && data.forEach((item , i)=>{
        NationnalitysCards += `
            <div onclick='PickNationnality(${item.nationality_id})' class='cursor-pointer text-white flex flex-col gap-4 px-2 py-3 rounded-md items-center bg-[#101744] hover:bg-[#1d2660]' >
              <img class='h-16' src='${item.nationality_img}' alt='' />
              <span>${item.nationality_name}</span>
            </div>
        ` ;
        })
    document.getElementById("playerslist").innerHTML = `
        <div id="clubsplayers" class="h-[69vh] overflow-y-auto py-5" >
                <div class="flex flex-wrap justify-center gap-1">
                ${NationnalitysCards.length>0 ? NationnalitysCards : `
                <div class="flex gap-2 ite px-5 py-2 w-full mt-10 border-2 border-gray-700 text-gray-200">
                Empty data </span>
                </div>`}
                </div>
        </div>
    `;
    }
}

function PanelMoveTo(pos){
  pos==1 && (
    document.getElementById("scrollbar").classList.add('left-0'),
    document.getElementById("scrollbar").classList.remove('left-[30%]'),
    document.getElementById("scrollbar").classList.remove('left-[60%]'),
    document.getElementById("scrollbar").classList.remove('w-28'),
    document.getElementById("scrollbar").classList.add('w-16'),
    document.getElementById("paneltitle").textContent = 'Players'
  )
  pos==2 && (
    document.getElementById("scrollbar").classList.remove('left-0'),
    document.getElementById("scrollbar").classList.add('left-[30%]'),
    document.getElementById("scrollbar").classList.remove('left-[60%]'),
    document.getElementById("scrollbar").classList.remove('w-28'),
    document.getElementById("scrollbar").classList.add('w-16'),
    document.getElementById("paneltitle").textContent = 'Clubs'
  )
  pos==3 && (
    document.getElementById("scrollbar").classList.remove('left-0'),
    document.getElementById("scrollbar").classList.remove('left-[30%]'),
    document.getElementById("scrollbar").classList.add('left-[60%]'),
    document.getElementById("scrollbar").classList.add('w-28'),
    document.getElementById("scrollbar").classList.remove('w-16'),
    document.getElementById("paneltitle").textContent = 'Nationnality'
  )
  TargetINdexPanel = pos;
  Display_All_Players()
}
Display_All_Players(false);

function PickClub(club_id){
  document.getElementById('panelclub').classList.remove('hidden');
  fetch('http://localhost:8582/clubs?id='+club_id)
  .then(res=>res.json())
  .then(data =>{
    if(data.length>0){
      setTimeout(() => {
      }, 2000);
      document.getElementById("txtclubpanel").value = data[0]?.club_name ;
      document.getElementById("updateimgclub").setAttribute('src' , data[0]?.club_img );
      document.getElementById("panelformclub").classList.remove("hidden")
   
    }
      console.log(data);
  })
}
function ClosePanelClub(e){
  e.preventDefault();
  document.getElementById('panelclub').classList.add('hidden');
}
function PickNationnality(nationality_id){
  alert("dsvdsv"+nationality_id)
}
// <<<<<<< HEAD
// const rangeInput = document.getElementById("RangePlayerRating");
// const RatingDisplay = document.getElementById("RatingDisplay");

// const updateRating = () => {
//   RatingDisplay.textContent = `Rating (${rangeInput.value}):`;
// };

// rangeInput.addEventListener("input", updateRating);

// updateRating();
// =======
//input range event lkola wa7d

const inputRange = ['Pace','Shooting','Passing','Defending','Dribbling','Physical'] 

inputRange.forEach((item)=>{
  document.getElementById("RangePlayer"+item).addEventListener("input", () => {
    const RatingDisplay = document.getElementById(item+"Display");
    RatingDisplay.textContent = `${item} (${document.getElementById("RangePlayer"+item).value}):`;
  });
})

let imageFile = null ;

function AddPlayer(event){
  event.preventDefault();
  let LocalId = parseInt(localStorage.getItem('lastid')) || 0
  if (!LocalId) {
    localStorage.setItem('lastid', parseInt(AllPlayersLis.length));
    LocalId = parseInt(AllPlayersLis.length) + 1;
  } else {
    localStorage.setItem('lastid', ++LocalId); 
  }
    const PlayerData = {
      id: LocalId ,
      name : document.getElementById("txtplayerName")?.value ,
      photo : "",
      cover : document.querySelector("#CoverCombo")?.value ,
      position : document.getElementById("ComboplayerPosition")?.value ,
      nationality : document.getElementById("FlagComboName")?.textContent ,
      flag : document.getElementById("FlagComboImg")?.getAttribute('src') ,
      club : document.getElementById("ClubComboName")?.getAttribute('data-id') ,
      clubname : document.getElementById("ClubComboName")?.textContent ,
      logo : document.getElementById("ClubComboImg")?.getAttribute('src') ,
      rating : document.getElementById("RangePlayerRating")?.value ,
      pace : document.getElementById("RangePlayerPace")?.value ,
      shooting : document.getElementById("RangePlayerShooting")?.value ,
      passing : document.getElementById("RangePlayerPassing")?.value ,
      dribbling : document.getElementById("RangePlayerDribbling")?.value ,
      defending : document.getElementById("RangePlayerDefending")?.value , 
      physical : document.getElementById("RangePlayerPhysical")?.value ,
  }
  if (checkfiledrequied(PlayerData , 0 /* 0 in case add player other like 1 in update */)) {
        UploadImgOnImgBB(PlayerData , 0);
  } 
}
function DeletePlayer(event){
  event.preventDefault();
    AllPlayersLis = AllPlayersLis.filter((element) => element.id != IdCArdPlaterSelected ) 
    //localStorage.setItem('ArrayPlayersData' , JSON.stringify(AllPlayersLis))
    Display_All_Players(true);
}

function checkfiledrequied(PlayerData , mode){
  let Findtrouble = false
  PlayerData.club==undefined ?
   (document.getElementById('textClublabel').textContent = '*' , Findtrouble = true)
   :document.getElementById('textClublabel').textContent = ''

  PlayerData.cover=="" ? (document.getElementById('textcoverlabel').textContent = '*', Findtrouble = true)
  :document.getElementById('textcoverlabel').textContent = ''
  
  PlayerData.flag==undefined ? (document.getElementById('textflaglabel').textContent = '*', Findtrouble = true)
  :document.getElementById('textflaglabel').textContent = ''
  
  PlayerData.name=="" ? (document.getElementById('textNamelabel').textContent = '*', Findtrouble = true)
  :document.getElementById('textNamelabel').textContent = ''

  PlayerData.name=="" || !regex(PlayerData.name) ? (document.getElementById('textNamelabel').textContent = '*', Findtrouble = true)
  :document.getElementById('textNamelabel').textContent = ''

  
  if(imageFile == null && mode == 0){
    document.getElementById('imagepanelR').textContent = '*' ; Findtrouble = true ;
  }
  else 
    document.getElementById('imagepanelR').textContent = ''
  // (imageFile == null && mode == 0) ? (document.getElementById('imagepanelR').textContent = '*', Findtrouble = true)
  // :document.getElementById('imagepanelR').textContent = ''
  return !Findtrouble
}
function regex(checking){
  let namePattern = /^[a-zA-Z\s]+$/
  return namePattern.test(checking)
}
const input = document.querySelectorAll("#fileInput");
input.forEach((input)=>{
  input.addEventListener("change", (event) => {
    const file = event.target.files[0];
    // console.log(event)
    if (file) {
        imageFile = file;   
    }
});
})


async function UploadImgOnImgBB(PlayerData , mode /* 0 in case add player other like 1 in update */){

  const apiKey = "5KTx8W74";
  //We have to make in the env file to make it more secure lmohim 9di o 3adi

  if(imageFile != null){
    window.width > 1000 &&  (document.getElementById("panleform").style.opacity = '0.5') ;
    document.getElementById("panleform").style.pointerEvents = 'none' ;
    document.getElementById("progressloading").classList.remove('hidden');
    
    const base64Image = await fileToBase64(imageFile);

    const formData = new FormData();
    formData.append("key", apiKey);
    formData.append("imgbase64", base64Image);
    try {
        const response = await fetch(`https://aminebb.controlesad.com/api/upload`, {
            method: "POST",
            body: formData,
        });
  
        if (!response.ok) {
            throw new Error("Failed to upload image");
        }
  
        const data = await response.json();
        PlayerData.photo = data.url;

        console.log(
          data
        )
        if(mode == 0){

          const formData = new FormData();
          formData.append('name', PlayerData.name);
          formData.append('photo', PlayerData.photo);
          formData.append('position', PlayerData.position);
          formData.append('cover', PlayerData.cover);
          formData.append('pace', PlayerData.pace);
          formData.append('shooting', PlayerData.shooting);
          formData.append('passing', PlayerData.passing);
          formData.append('dribbling', PlayerData.dribbling);
          formData.append('defending', PlayerData.defending);
          formData.append('physical', PlayerData.physical);
          formData.append('nationality_id', 1);
          formData.append('club_id', PlayerData.club);
          console.log({ club :  PlayerData.club})
          const apiResponse = await fetch(
              `http://localhost:8582/addplayers`,
              {
                  method: 'POST',
                  body: formData
              }

          );

          if (!apiResponse.ok) {
              const errorText = await apiResponse.text();
              throw new Error(`HTTP error! status: ${apiResponse.status}, message: ${errorText}`);
          }
          const data = apiResponse.json();
          console.log(data);
          //AllPlayersLis.splice(0,0,PlayerData)
          Display_All_Players(false);
          //localStorage.setItem('ArrayPlayersData' , JSON.stringify(AllPlayersLis))
    
        }else{
          const queryParams = new URLSearchParams({
            id: PlayerData.id,
            name: PlayerData.name,
            photo: PlayerData.photo,
            position: PlayerData.position,
            cover: PlayerData.cover,
            pace: PlayerData.pace,
            shooting: PlayerData.shooting,
            passing: PlayerData.passing,
            dribbling: PlayerData.dribbling,
            defending: PlayerData.defending,
            physical: PlayerData.physical,
            nationality_id: 1,
            club_id: PlayerData.club
         });
              const apiResponse = await fetch(
                `http://localhost:8582/editplayers?${queryParams}`,
                {
                    method: 'PUT'
                }
    
            );

          if (!apiResponse.ok) {
              const errorText = await apiResponse.text();
              throw new Error(`HTTP error! status: ${apiResponse.status}, message: ${errorText}`);
          }
          const data = apiResponse.json();
          console.log(data);

            //localStorage.setItem('ArrayPlayersData' , JSON.stringify(AllPlayersLis))
        
            Display_All_Players(true);
            
        }
   
        document.getElementById("panleform").style.opacity = '1' ;
        document.getElementById("panleform").style.pointerEvents = 'auto' ;
        document.getElementById("progressloading").classList.add('hidden');

    } catch (error) {
        console.error("Error uploading image:", error);
        throw error;
    }
  }
  else{

      const queryParams = new URLSearchParams({
        id: PlayerData.id,
        name: PlayerData.name,
        photo: PlayerData.photo,
        position: PlayerData.position,
        cover: PlayerData.cover,
        pace: PlayerData.pace,
        shooting: PlayerData.shooting,
        passing: PlayerData.passing,
        dribbling: PlayerData.dribbling,
        defending: PlayerData.defending,
        physical: PlayerData.physical,
        nationality_id: 1,
        club_id: PlayerData.club
     });

          const apiResponse = await fetch(
            `http://localhost:8582/editplayers?${queryParams}`,
            {
                method: 'PUT'
            }

        );

        if (!apiResponse.ok) {
            const errorText = await apiResponse.text();
            console.log(`HTTP error! status: ${apiResponse.status}, message: ${errorText}`);
        }
        const data = apiResponse.json();
    Display_All_Players(true);


  }




  
}
function fileToBase64(file) {
  return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.onloadend = () => resolve(reader.result);  // Resolve with Base64 string
      reader.onerror = reject;  // Reject on error
      reader.readAsDataURL(file);  // Start reading the file as Base64
  });
}

function OpenFormPanel(id , mode){
  document.getElementById("FormPanelEdit").classList.remove("hidden")

  if(document.getElementById("FormPanel").getAttribute('isopned') == 'true' && id !=0){
    document.getElementById("FormPanel").setAttribute('isopned','false')
    document.getElementById("FormPanel").classList.add("grid-cols-1")
    document.getElementById("FormPanel").classList.remove("grid-cols-[1fr,600px]")
    // document.getElementById("FormPanel").classList.remove("grid-cols-[1fr,auto]")  
    // if(window.width > 1150){
      
    // }else{
    //   document.getElementById("FormPanel").classList.remove("grid-cols-1")
    //   document.getElementById("FormPanel").classList.remove("grid-cols-[1fr,auto]")  
    //   // document.getElementById("FormPanel").classList.add("grid-rows-[auto,1fr]")
    //   // document.getElementById("datalistplayers").classList.remove('h-[70vh]')
    //   // document.getElementById("datalistplayers").classList.add('h-[20vh]')
    // }

    document.getElementById("FormPanelEdit").classList.remove("w-auto")
    document.getElementById("FormPanelEdit").classList.add("w-[0px]")
  }
  else{
    document.getElementById("FormPanel").setAttribute('isopned','true')

    document.getElementById("FormPanel").classList.remove("grid-cols-1")
    document.getElementById("FormPanel").classList.add("grid-cols-[1fr,600px]")

    document.getElementById("FormPanelEdit").classList.add("w-auto")
    document.getElementById("FormPanelEdit").classList.remove("w-[0px]")
  }
  id==0 ?( document.getElementById("formsubmitbtn").setAttribute("onclick" , "UpdatePlayer(event)" ) ,
  document.getElementById('uploadedit').classList.remove('hidden'),
  document.getElementById('uploadadd').classList.add('hidden'),
  document.getElementById("formsubmitbtn").innerHTML =`` ,
  document.getElementById("formsubmitbtn").classList.remove('bg-[#6158CA]') ,
  document.getElementById("formsubmitbtn").classList.add('bg-[#00877A]') ,
  document.getElementById("formsubmitbtn").innerHTML =`<i class="fa-solid fa-rotate-right"></i>` ,
  document.getElementById("formdelbtn").classList.remove('hidden') 

  )
  : (document.getElementById("formsubmitbtn").setAttribute("onclick" , "AddPlayer(event)" ) , 
  document.getElementById('uploadedit').classList.add('hidden'),
  document.getElementById('uploadadd').classList.remove('hidden'),
  document.getElementById("formsubmitbtn").classList.remove('bg-[#00877A]') ,
  document.getElementById("formsubmitbtn").classList.add('bg-[#6158CA]') ,
  document.getElementById("formsubmitbtn").innerHTML =`` ,
  document.getElementById("formsubmitbtn").innerHTML =`<i class="fa-solid fa-floppy-disk"></i>` ,
  document.getElementById("formdelbtn").classList.add('hidden') 
  )
  if(mode != -1){
    IdCArdPlaterSelected = mode

  const playerPikced = AllPlayersLis.find((item)=> item.id == IdCArdPlaterSelected) 
  if(playerPikced){

      const PlayerData = {
        id : playerPikced.id ,
        name : document.getElementById("txtplayerName"),
        photo : document.getElementById("updateimg"),
        cover : document.querySelector("#CoverCombo"),
        position : document.getElementById("ComboplayerPosition"),
        nationality : document.getElementById("FlagComboName") ,
        flag : document.getElementById("FlagComboImg")?.getAttribute('src') ,
        club : document.getElementById("ClubComboName")?.getAttribute('data-id') ,
        clubname : document.getElementById("ClubComboName")?.textContent ,
        logo : document.getElementById("ClubComboImg")?.getAttribute('src') ,
        rating : document.getElementById("RangePlayerRating") ,
        pace : document.getElementById("RangePlayerPace") ,
        shooting : document.getElementById("RangePlayerShooting") ,
        passing : document.getElementById("RangePlayerPassing") ,
        dribbling : document.getElementById("RangePlayerDribbling") ,
        defending : document.getElementById("RangePlayerDefending") , 
        physical : document.getElementById("RangePlayerPhysical") ,
    }

    
    PlayerData.name.value = playerPikced.name
    PlayerData.position.value =playerPikced.position
    PlayerData.photo?.setAttribute("src" ,playerPikced.photo ) ;

    // const option = document.createElement('option');
    // option.value = playerPikced.flag ;
    // option.textContent = playerPikced.nationality ;
    // document.getElementById('FlagCombo').appendChild(option)

    // ;
    CoverCombo.setValue(playerPikced.cover);
    ClubCombo.setValue(playerPikced.clubname);
    FlagCombo.setValue(playerPikced.nationality)


    // PlayerData.rating.value = playerPikced.rating
    PlayerData.pace.value = playerPikced.pace
    PlayerData.shooting.value = playerPikced.shooting
    PlayerData.passing.value =playerPikced.passing
    PlayerData.dribbling.value = playerPikced.dribbling
    PlayerData.defending.value = playerPikced.defending
    PlayerData.physical.value = playerPikced.physical

    const inputRange = ['Pace','Shooting','Passing','Defending','Dribbling','Physical'] 
    document.getElementById(inputRange[0]+"Display").textContent = `${inputRange[0]} (${playerPikced?.rating}):`;
    document.getElementById(inputRange[1]+"Display").textContent = `${playerPikced?.pace ?  inputRange[1] :'Diving'} (${playerPikced?.pace ?? playerPikced?.diving}):`;
    document.getElementById(inputRange[2]+"Display").textContent = `${playerPikced?.shooting ? inputRange[2]:'Handling'} (${playerPikced?.shooting ?? playerPikced?.handling}):`;
    document.getElementById(inputRange[3]+"Display").textContent = `${playerPikced?.dribbling ? inputRange[3]:'Kicking'} (${playerPikced?.dribbling ?? playerPikced?.kicking}):`;
    document.getElementById(inputRange[4]+"Display").textContent = `${playerPikced?.defending ? inputRange[4]:'Reflexes'} (${playerPikced?.defending ?? playerPikced?.reflexes}):`;
    document.getElementById(inputRange[4]+"Display").textContent = `${ playerPikced?.physical ? inputRange[4]:'Speed'} (${playerPikced?.physical ?? playerPikced?.speed}):`;
  }
}
 

}

function UpdatePlayer(e){
  e.preventDefault()

  const PlayerData = {
    id : IdCArdPlaterSelected,
    name : document.getElementById("txtplayerName")?.value ,
    photo : document.getElementById("updateimg")?.getAttribute('src') ,
    cover : document.querySelector("#CoverCombo")?.value ,
    position : document.getElementById("ComboplayerPosition")?.value ,
    nationality : document.getElementById("FlagComboName")?.textContent ,
    flag : document.getElementById("FlagComboImg")?.getAttribute('src') ,
    club : document.getElementById("ClubComboName")?.getAttribute('data-id') ,
    clubname : document.getElementById("ClubComboName")?.textContent ,
    logo : document.getElementById("ClubComboImg")?.getAttribute('src') ,
    rating : document.getElementById("RangePlayerRating")?.value ,
    pace : document.getElementById("RangePlayerPace")?.value ,
    shooting : document.getElementById("RangePlayerShooting")?.value ,
    passing : document.getElementById("RangePlayerPassing")?.value ,
    dribbling : document.getElementById("RangePlayerDribbling")?.value ,
    defending : document.getElementById("RangePlayerDefending")?.value , 
    physical : document.getElementById("RangePlayerPhysical")?.value ,
}


if (checkfiledrequied(PlayerData , 1)) {
  // document.getElementById("panleform").style.pointerEvents = 'none' ;
  // document.getElementById("progressloading").classList.remove('hidden');
  UploadImgOnImgBB(PlayerData , 1 /*update */);
  closepanel();

} 

}

function ClosePopPUPFormulaire(e){
  e.preventDefault();
  closepanel();
}
function closepanel(){
  document.getElementById("FormPanel").classList.remove('grid-cols-[1fr,600px]')
  document.getElementById("FormPanelEdit").classList.add('w-[0px]')
  document.getElementById("FormPanel").setAttribute('isopned','false')

  imageFile = null
  const input = document.querySelectorAll("#fileInput");
  input.forEach((fileInput)=>fileInput.value = "")
  
  const playerPikced = AllPlayersLis.find((item)=> item.id == IdCArdPlaterSelected) 



  IdCArdPlaterSelected = -1 ;

  FlagCombo.clear();
  ClubCombo.clear();
  CoverCombo.clear();

  if(playerPikced){

    const PlayerData = {
      name : document.getElementById("txtplayerName"),
      photo : document.getElementById("updateimg"),
      cover : document.querySelector("#CoverCombo"),
      position : document.getElementById("ComboplayerPosition"),
      nationality : document.getElementById("FlagComboName") ,
      flag : document.getElementById("FlagComboImg")?.getAttribute('src') ,
      club : document.getElementById("ClubComboName")?.getAttribute('data-id') ,
      clubname : document.getElementById("ClubComboName")?.textContent ,
      logo : document.getElementById("ClubComboImg")?.getAttribute('src') ,
      rating : document.getElementById("RangePlayerRating") ,
      pace : document.getElementById("RangePlayerPace") ,
      shooting : document.getElementById("RangePlayerShooting") ,
      passing : document.getElementById("RangePlayerPassing") ,
      dribbling : document.getElementById("RangePlayerDribbling") ,
      defending : document.getElementById("RangePlayerDefending") , 
      physical : document.getElementById("RangePlayerPhysical") ,
  }

    // PlayerData.rating.value = playerPikced.rating
    PlayerData.pace.value = 10 ;
    PlayerData.shooting.value = 10 ;
    PlayerData.passing.value =10 ;
    PlayerData.dribbling.value =10 ;
    PlayerData.defending.value = 10 ;
    PlayerData.physical.value = 10 ;

    const inputRange = ['Pace','Shooting','Passing','Defending','Dribbling','Physical'] 
    document.getElementById(inputRange[0]+"Display").textContent = `${inputRange[0]} (10):`;
    document.getElementById(inputRange[1]+"Display").textContent = `${playerPikced?.pace ?  inputRange[1] :'Diving'} (10):`;
    document.getElementById(inputRange[2]+"Display").textContent = `${playerPikced?.shooting ? inputRange[2]:'Handling'} (10):`;
    document.getElementById(inputRange[3]+"Display").textContent = `${playerPikced?.dribbling ? inputRange[3]:'Kicking'} (10):`;
    document.getElementById(inputRange[4]+"Display").textContent = `${playerPikced?.defending ? inputRange[4]:'Reflexes'} (10):`;
    document.getElementById(inputRange[4]+"Display").textContent = `${ playerPikced?.physical ? inputRange[4]:'Speed'} (10):`;

  }

  
}
const FlagCombo = new TomSelect('#FlagCombo',{
  valueField: 'name',
  searchField: 'name',
  render: {
    option: function(item, escape) {
      return `<div class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img  class="h-4 w-4" src="${item.img}" >
          <span  >${item.name}</span>
        </div>`;
    },
    item: function(item, escape) {
      return `<div id="Flaginput" class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img id="FlagComboImg" class="h-4 w-4" src="${item.img}" >
          <span id="FlagComboName">${item.name}</span>
        </div>`;
    }
  },
});

const ClubCombo = new TomSelect('#ClubCombo',{
  valueField: 'club_name',
  searchField: 'club_name',
  render: {
    option: function(item, escape) {
      return `<div class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img class="h-4 w-4" src="${item.club_img}" >
          <span>${item.club_name}</span>
        </div>`;
    },
    item: function(item, escape) {
      return `<div id="Flaginput" class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img id="ClubComboImg" class="h-4 w-4" src="${item.club_img}" >
          <span id="ClubComboName" data-id="${item.club_id}">${item.club_name}</span>
        </div>`;
    }
  },
});

const CoverCombo = new TomSelect('#CoverCombo',{
  valueField: 'img',
  searchField: 'name',
  render: {
    option: function(item, escape) {
      return `<div class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img class="h-4 w-4" src="${item.img}" >
          <span>${item.name}</span>
        </div>`;
    },
    item: function(item, escape) {
      return `<div id="Flaginput" class="custom-option grid grid-cols-[auto,1fr] gap-3 items-center">
          <img class="h-4 w-4" src="${item.img}" >
          <span>${item.name}</span>
        </div>`;
    }
  },
});


fetch('../Data/nation.json')
.then(response => response.json())
.then(data => {
  FlagCombo.addOptions(data);
})

fetch('http://localhost:8582/clubs')
.then(response => response.json())
.then(data => {
    ClubCombo.addOptions(data);
})
fetch('../Data/card.json')
.then(response => response.json())
.then(data => {
  CoverCombo.addOptions(data);
  
})







