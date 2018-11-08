//fonction englobante espace privé
  (function(){
    //console.log('hello');
    const playerForm = document.querySelector('#playerForm');
    const name = playerForm.querySelector('#name');
    const position = playerForm.querySelector('#position');
    const submit = playerForm.querySelector('#submit');
    const teamId = playerForm.querySelector('#team_id');
    const playersTable = document.querySelector('#playersTable tbody');
    //const btnsEdit= playersTable.querySelectorAll('.btnEdit');
    let btnsEdit = document.getElementsByClassName('btnEdit');
    let btnsDelete = document.getElementsByClassName('btnDelete');

    //Aucun joueur est en cours d'édition
    let editedPlayerId = null;
    let editedRow = null;

    //console.log(btnsEdit);
    //Verification
    //playersTable.style.display= 'none';

    submit.addEventListener('click',(e) =>{
      e.preventDefault();//bloque la requete http standard
      //provoqué par le click sur un input submit placé dans une balise <form>

      let player={
        name: name.value,
        position: position.value,
        //team_id: teamId.value
      };

      let url="";
      //
      if (editedPlayerId == null){
        url='../process_player.php';
        //ajout de l'identifiant de l'equipe associés au joueurs//que l'on souhaite enregistrer en DB
        player.team_id= teamId.value
      }else {//mode update
        url='player_update.php';
        player.id = editedPlayerId;
      }
      //console.log(player);

    //  console.log(player);
      //requete ajax
      fetch(url, {
      headers:{'Content-Type':'application/json'},
      method:'post',
      body:JSON.stringify(player),
    })
    .then(res=>res.text())
    .then(res=>{

      console.log(res);
      //mettre a jour de DOM afi d'afficher le nouveau
      //enregistrer en base de données

      if(editedPlayerId == null){//insert
        //dans ce mode, res correspond à l'identifiant du dernier joueur enregistré en DB
        let html = playersTable.innerHTML;
        let tr= `
        <tr>
        <td>${player.name}</td>
        <td>${player.position}</td>
        <td>
        <button data-id="${res}" class="btnEdit btn btn-warning btn-sm">Editer</button>
        <button data-id="${res}"class="btnDelete btn btn-danger btn-sm">Supprimer</button>
        </td>
        </tr>
        `;
        html += tr; // Concatenation du balisage html actuel
        //avec la nouvelle ligne
        playersTable.innerHTML= html;//Mise a jour du DOM
        //Cette affectation ecrase  une partie du document
        // les ecouteurs d'evenement sont détruit
        //On doit remettre en place l'ecoute evenementielle.
        //on rapelle la fonction addEventsToBtns
        addEventsToBtns();
      }else {//mode update/edition
          //on met a jour les infos du joueurs édité dans le DOM (front)
          editedRow.children[0].innerText= player.name;
          editedRow.children[1].innerText=player.position;

          clear();
      }
        })




  });//fin de addEventListener



    function addEventsToBtns(){
      for (let i =0; i< btnsEdit.length; i++){
        btnsEdit[i].addEventListener('click', e=>{
          editedRow = e.target.parentNode.parentNode;
          let tr= e.target.parentNode.parentNode;

          let player ={
          name: tr.children[0].innerText.trim(),
          position: tr.children[1].innerText.trim(),
          id: e.target.dataset.id
        }
        //console.log(player);
        editedPlayerId = player.id;
        name.value= player.name;
        position.value= player.position;
        submit.value = 'Mettre à jour';
          //console.log(player);


        })
      }
      for (let i=0; i<btnsDelete.length;i++){
        btnsDelete[i].addEventListener('click',e=>{
          fetch('player_delete.php?id=' + e.target.dataset.id)
          .then(res=>res.text())
          .then(res =>{
            console.log(res);
            //mettre a jour du DOM
            let supprimer= e.target.parentNode.parentNode.remove();
            if(res == 1){
              supprimer;
            }
          })
        })//fin du addEventListener
      }//fin du for
  }//fin de addEventsToBtns
  function clear(){
    editedPlayerId = null;
    editedRow = null;
    name.value='';
    position.value='Gardien';
    submit.value= 'Enregistrer';
  }

  function init(){
    addEventsToBtns();

  }




  init();

  })()
