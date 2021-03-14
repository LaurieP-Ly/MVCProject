window.onload = function(){


    var ImgDerouleRecette = document.getElementById("imgDerouleRecette");
    
    ImgDerouleRecette.onchange = function() {
        if(this.files[0].size > 34612){
            alert("Veuillez entrer une image de maximum 763px*354px");
            this.value = "";
         };
    }
    
    }