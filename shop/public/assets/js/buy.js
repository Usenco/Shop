
      $( function() {
        $( "#accordion" ).accordion({
          collapsible: true
        });
      } );



  let selectedcity = false;
  let selecteddepart = false;
  let departments = [];
  let postomates = [];
  let streets = [];
  let cities = new Map();
  let citie;
  let depart;
  let street;
  
  $( function() {
    var cache = {};
    var cacheFull = {};
    let bool = true;
    $( "#cities" ).autocomplete({
      minLength: 2,
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          setTimeout(function(){
            $(".ui-menu-item").on("click",function()
            { /* let i = this.id.slice(6) - document.querySelector(".ui-menu-item").id.slice(6);
              citie = Array.from(cities)[i][1]; */
              selectedcity =  true;
              });
          },10)
          cities = cacheFull[term];
          return;
        }
        $.getJSON( "http://127.0.0.1:8000/api/np/",
                   {     "modelName": "Address",
                         "calledMethod": "getCities",
                         "methodProperties": {
                             "Warehouse": 1,
                             "Limit": 10,
                             "FindByString": term
                         }
                     }
         , function( data, status, xhr ) {
           let terms=[];
           let cittmp = new Map();
           bool = true;
          $.each( data.data, function( key, val ){
            if(bool){bool= false;citie = val.Ref;}
              terms.push(val.Description);
              cittmp.set(val.Description,val.Ref);
          });
          cache[ term ] = terms;
          cacheFull[ term ] = cittmp;
          cities = cittmp;
          response( terms );
          setTimeout(function(){
            $(".ui-menu-item").on("click",function(){
              selectedcity =  true;});
          },50)
        });
      }
    });
  } );
  $( function() {
  $( "#departments" ).autocomplete({
      source: function( request, response ) {
        var term = request.term;
        var responses = [];
        departments.forEach(i => {
          if(responses.length >=10 )return;
          if(i[1].includes(term))responses.push(i[1]);
        });
          response( responses );
          setTimeout(function(){
            $(".ui-menu-item").on("click",function(){
              selecteddepart =  true;});
          },50)
          return;
        
      }
    });
  });
  $( function() {
  $( "#parcel_machines" ).autocomplete({
      source: function( request, response ) {
        var term = request.term;
        var responses = [];
        postomates.forEach(i => {
          if(responses.length >=10 )return;
          if(i[1].includes(term))responses.push(i[1]);
        });
          response( responses );
          setTimeout(function(){
            $(".ui-menu-item").on("click",function(){
              selecteddepart =  true;});
          },50)
          return;
        
      }
    });
  });

    $( function() {
    $( "#streets" ).autocomplete({
      minLength: 2,
      source: function( request, response ) {
        var term = request.term;
        $.getJSON( "http://127.0.0.1:8000/api/np/",
                   { "modelName": "Address",
                     "calledMethod": "getStreet",
                     "methodProperties":{
                         "Limit":10,
                         "CityRef":citie,
                         "FindByString":term
                     }
                   }
         , function( data, status, xhr ) {
           let terms=[];
           streets = [];
          $.each( data.data, function( key, val ){
              terms.push(val.Description);
              streets.push([val.Ref,val.Description]);
          });
          response( terms );
          setTimeout(function(){
            $(".ui-menu-item").on("click",function(){
              selecteddepart =  true;});
          },50)
        });
      }
    });
  } );

  function setDepartments(){
    if(citie==null)return;
    var cache = {};
    
    $.getJSON( "http://127.0.0.1:8000/api/np/",
               {     "modelName": "Address",
                    "calledMethod": "getWarehouses",
                     "methodProperties":{
                         "CityRef":citie
                     }
                 }
     , function( data, status, xhr ) {
       let termsDepart=[];
       let termsPostomat=[];
      $.each( data.data, function( key, val ){
          if(val.CategoryOfWarehouse=="Postomat"){
            termsPostomat.push([val.Ref,val.Description]);
          }
          else termsDepart.push([val.Ref,val.Description]);
      });
      departments = termsDepart;
      postomates = termsPostomat;

     });
     
  }
