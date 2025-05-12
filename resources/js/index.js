//jelszó-megjelenítők
const passBar = document.getElementById("password");
if (passBar){
    const showPassButton = document.getElementById("showPassButton");
    const showPassIcon = document.getElementById("showPassIcon");
    
    const passConfirmBar = document.getElementById("passwordConfirm");
    const showConfirmPassButton = document.getElementById("showConfirmPassButton");
    const showConfirmPassIcon = document.getElementById("showConfirmPassIcon");
    
    function setupPasswordEye(bar,btn,icon){
        btn.onclick = function(){
            if (bar.type == "password") {
                icon.className = "bi bi-eye-fill clr-yellow"
                bar.type = "text";
            } else {
                icon.className = "bi bi-eye-slash-fill clr-gray"
                bar.type = "password";
            }
        }
    }
    
    setupPasswordEye(passBar,showPassButton,showPassIcon);
    setupPasswordEye(passConfirmBar,showConfirmPassButton,showConfirmPassIcon);
}

//kapcsolat google térkép
const contactMap = document.getElementById("contactMap");
if (contactMap){
    /**
    * license
    * Copyright 2019 Google LLC. All Rights Reserved.
    * SPDX-License-Identifier: Apache-2.0
    */
    let map;
    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");

        map = new Map(contactMap, {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
        });
    }
    initMap();
}

//áru oldal
const productButtonDiv = document.getElementById("productButtonDiv");
if (productButtonDiv) {
    const descriptionFrame = document.getElementById("descriptionFrame");
    const parameterFrame = document.getElementById("parameterFrame");
    const reviewFrame = document.getElementById("reviewFrame");
    const descriptionButton = document.getElementById("descriptionButton");
    const parameterButton = document.getElementById("parameterButton");
    const reviewButton = document.getElementById("reviewButton");
    const frames = [descriptionFrame,parameterFrame,reviewFrame];
    const buttons = [descriptionButton,parameterButton,reviewButton];

    function handleFrameButton(button,frame){
        button.onclick = function(){
            frames.forEach(element => {
                element.style.display = "none";
            });
            buttons.forEach(element => {
                element.className = "btn btn-gray clr-light";
            });
            button.className = "btn btn-yellow clr-black";
            frame.style.display = "";
        }
    }

    handleFrameButton(descriptionButton,descriptionFrame);
    handleFrameButton(parameterButton,parameterFrame);
    handleFrameButton(reviewButton,reviewFrame);
}
