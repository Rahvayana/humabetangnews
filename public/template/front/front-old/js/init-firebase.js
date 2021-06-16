  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDLK41IhcOKfY6g-5_75guxbxX0LU6BqBQ",
    authDomain: "huma-betang.firebaseapp.com",
    databaseURL: "https://huma-betang.firebaseio.com",
    projectId: "huma-betang",
    storageBucket: "huma-betang.appspot.com",
    messagingSenderId: "492014248870",
    appId: "1:492014248870:web:bdc044880f8bf06814e567",
    measurementId: "G-V87JF9VLDT"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  console.log(firebase.app().name);


  //login
$(".login").on('click', function(event){

    var provider = new firebase.auth.GoogleAuthProvider();
    provider.addScope('profile');
    provider.addScope('email');
    firebase.auth().signInWithPopup(provider).then(function(result) {
      // This gives you a Google Access Token. You can use it to access the Google API.
      var token = result.credential.idToken;
    //   var accessToken = result.credential.accessToken;


    //   var token = result.getAuthResponse().id_token;
      // The signed-in user info.
      var user = result.user;

    //   console.log('exp '+user.stsTokenManager["expirationTime"]);
    //   var str1 = JSON.stringify(user.expirationTime, null, 2);
    // console.log('str1 '+ str1);


      $("#authtoken").val(token);
      $("#uid").val(user.providerData[0].uid);
      $("#providerId").val(user.providerData[0].providerId);
      $("#email").val(user.providerData[0].email);
      $("#picture").val(user.providerData[0].photoURL);
      $("#username").val(user.providerData[0].displayName);
    //   $("#exp").val(user.stsTokenManager.expirationTime);

      var str = JSON.stringify(user, null, 2);

    //   console.log("data "+str);
    //   console.log("token "+token);


      $('#login-auth').submit();


      // ...
    }).catch(function(error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      // The email of the user's account used.
      var email = error.email;
      // The firebase.auth.AuthCredential type that was used.
      var credential = error.credential;

      console.log('error '+errorMessage);
      // ...
    });

});

firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      user.getIdToken().then(function(idToken) {
        console.log('idTOken '+idToken);
      });
    }
  });

