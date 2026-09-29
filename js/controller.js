// admin profile

app.controller('adminInfo', function($scope){

	$scope.data=[

		{name:'Varun Dev', email:'varundev2727@gmail.com',contact:'+91-9891189122'}

	]

});



// Nav Controller

app.controller('navCtrl', function($scope){



	$scope.userInfo=[

		{userImg:'img/user.jpg', name:'Varun Dev', role:'Admin'}

	],



	// $scope.userImg="img/user.jpg";

	// $scope.name="Varun Dev";

	// $scope.email="Admin";



    $scope.menu = [

        { faicon:'fa-dashboard', url: 'dashboard.php', text: 'Dashboard'},

        { faicon:'fa-users', url: '#', text: 'User Managment', tgt: 'uikit', ddicon:'caret',

            	

            	submenu: [

	                { text: 'Add User', url: 'adduser.php' },

	                { text: 'View User', url: '#'},

            	]

        },



        { faicon:'fa-envelope', url: 'form1.php', text: 'Customer Problem Report'},

    ];



});



// Stats

app.controller('stats', function($scope){



	$scope.stats=[

		{icon:'fa-bar-chart-o', bgColor:'skin-red', title:'Today view', total:'223232'},

		{icon:'fa-dollar', bgColor:'skin-sky',title:'Revenew', total:'565545'},

		{icon:'fa-gift', bgColor:'skin-purple',title:'Item Sales', total:'445454'},

		{icon:'fa-shopping-cart', bgColor:'skin-pink',title:'New orders', total:'345456'}

	]



});





// todo

  app.controller('TodoListController', function() {

    

    

    

  });





// client-list

app.controller('clientListController', function($scope) {

    	

  	$scope.data=[

  		{url:'#', bgColor:'skin-red',firstLetter:'V', clientName:'Varun Dev', desg:'Frontend Developer'},

  		{url:'#', bgColor:'skin-pink',firstLetter:'L', clientName:'Levon', desg:'UI/UX Designer'},

  		{url:'#', bgColor:'skin-purple',firstLetter:'Y', clientName:'Yana', desg:'Marketing Manager'},

  		{url:'#', bgColor:'skin-sky',firstLetter:'S', clientName:'Stacy', desg:'HR Admin'},

  		{url:'#', bgColor:'skin-pink',firstLetter:'L', clientName:'Levon', desg:'UI/UX Designer'},

  		{url:'#', bgColor:'skin-purple',firstLetter:'Y', clientName:'Yana', desg:'Marketing Manager'},

  		{url:'#', bgColor:'skin-sky',firstLetter:'S', clientName:'Stacy', desg:'HR Admin'}

  	]



});





app.controller('autoSuggest', function($scope, $http){



	$http.get('js/citydata.json').then(function(response) {

        $scope.data = response.data;

    });



});

