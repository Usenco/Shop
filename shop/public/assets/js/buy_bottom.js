let count_return = $("#count_return");
let num = $('#numel');
let comprc = $("#comprice");
let price = $("#price").val();
let wholeprice = $("#whole_price").val();
let wholenum = $("#whole_num").val();

let count = 1;
if($("#count_server").val()!=""){
  count = $("#count_server").val();
}

refreshPrice()

$('#minus').on("click",function()
{
  
  if(count-1>0)
  {
    count--;
    num.html(count+"");
    count_return.val(count);
    refreshPrice()
  }
});
$('#plus').on("click",function()
{
    count++;
    num.html(count+"");
    count_return.val(count);
    refreshPrice()
});

function refreshPrice()
{
  if(count < wholenum){
     comprc.html((count*price)+"");
  }
  else
  {
    comprc.html((count*wholeprice)+"");
  }
}

//////////////////
////////////////
if($("#hidecitie").val() != "")citie = $("#hidecitie").val();
setDepartments();
if($("#btntextin").val() != "")
{
  $(".btn1").find(".btntext").html($("#btntextin").val());
}
if($("#btnimgin").val() != "")
{
  $(".btn1").find(".btnimg").attr("src",$("#btnimgin").val());
}
//////////////
////////////////////////

    let htmlarea = $("#postarea");
    let btn;
    let choose = "department";
    let cururl;
    let curtext;
    function refreshPost()
    {
        btn.find(".btnimg").attr("src",cururl);
        btn.find(".btntext").html(curtext);
        if(curtext == "нова пошта")
        {
           newhtml();
           choose = $("#"+$(".btn2").data().choose);
        }
        else if(curtext == "укрпошта")
        {
           ukrhtml();
           choose = $("#"+$(".btn3").data().choose);
        }
    }

    $(".item").on("click",function(){
      curtext = $(this).data().text;
      cururl = $(this).data().url;
      btn = $("."+$(this).data().parent);
      choose = $("#"+$(this).data().choose);
      $(btn).data().choose = $(this).data().choose;
      refreshPost();
      hidechoose(choose);
      if($(this).data().parent == "btn1")
      {
        $("#btntextin").val(curtext);
        $("#btnimgin").val(cururl);
      }
  });

  ////////////
  /////////////
  ////////////

let ukrp = $("#ukr");
let newp = $("#new");
let post_return = $("#post_return");
let where_in_post = $("#where_in_post");

let cit = $("#citie");
let pm = $("#parcel_machine");
let d = $("#department");
let c = $("#courier");

if(post_return.val()=="new"){
  ukrp.hide();
}
else if(post_return.val()=="ukr"){
  newp.hide();
}

if(where_in_post.val()=="depart"){
  hidechoose("#department");
}
else if(where_in_post.val()=="courier"){
  hidechoose("#courier");
}
else if(where_in_post.val()=="parcel_machine"){
  hidechoose("#parcel_machine");
}
else
{
  hidechoose("#department");
}

function ukrhtml()
{
  newp.hide();
  ukrp.show();
  post_return.val("ukr");
  pm.find("input").val("");d.find("input").val("");
  c.find("input").val("");cit.find("input").val("");
  $("#hidewhere").val("");
};
function newhtml()
{
  newp.show();
  ukrp.hide();
  post_return.val("new");
  pm.find("input").val("");d.find("input").val("");
  c.find("input").val("");cit.find("input").val("");
  $("#hidewhere").val("");
};
function hidechoose(sel)
{
  el = $(sel);
  if(el.attr('id') == pm.attr('id')
   ||el.attr('id')  == d.attr('id')
   ||el.attr('id')  == c.attr('id')){
    pm.hide();
    d.hide();
    c.hide();
    el.show();
    where_in_post.val(el.attr('id'));
  }
  sel = sel.slice(1);
document.querySelectorAll(".item").forEach(element => {
  if($(element).data().choose==sel){
    $(element).trigger("click");
  }
});
};

//////////////
//////////////////////////////
  document.querySelector("#cities").onblur = function(){
    $("#departments").val("");
    $("#parcel_machines").val("");
    $("#streets").val("");
    departments = [];
    postomates = [];
    streets = [];
    if(selectedcity==true){
      for (let pair of cities) {
        if(pair[0] == $("#cities").val())
        {
          citie = pair[1];
          $("#hidecitie").val(citie);
        }
      } 
      setDepartments();
      $("#citieError").html("");
      return;}
    if(citie == null && selectedcity == false){$("#hidecitie").val("");$("#citieError").html("citie not found");return;}

    for (let pair of cities) {
          citie = pair[1];
          $("#hidecitie").val(citie);
          $("#cities").val(pair[0]);
          break;
      } 
    setDepartments();
    $("#citieError").html("");
}
document.querySelector("#cities").onkeydown = function(event)
      {
        let e = event;
          let el = document.querySelector(".ui-state-focus");
          
          if(el!=null && (e.key == "ArrowDown" || e.key == "ArrowUp"))
          {              
             selectedcity = true;
          }
          else if(el!=null && e.key == "Enter")
          {
            selectedcity = true;
          }
          else
          {
            citie = null;
            selectedcity = false;
          }
           
      };

function DepPost(name,error,errortag,arrname,hidetag){
document.querySelector(name).onblur = function(){
    let arr;
    if(arrname == "departments")arr = departments;
    else if(arrname == "postomates")arr = postomates;
    else if(arrname == "streets")arr = streets;
    if(selecteddepart==true){
      let tmp = $(name).val();
      arr.forEach(i => {
        if(i[1] == tmp)
        {
          depart = i[0];
          $(hidetag).val(depart);
        }
      });
      $(errortag).html("");
      return;}
    $(errortag).html("");
    arr.forEach(i => {
      if( i[1].includes($(this).val()) ){        
        $(this).val(i[1]);
        selecteddepart = true;
        depart = i[0];
        $(hidetag).val(citie);
        return;
      }
    });
    if(selecteddepart == false){$(hidetag).val("");$(errortag).html(error);return;}
}
document.querySelector(name).onkeydown = function(event)
      {
        let e = event;
          let el = document.querySelector(".ui-state-focus");
          
          if(el!=null && (e.key == "ArrowDown" || e.key == "ArrowUp"))
          {              
             selecteddepart = true;
          }
          else if(el!=null && e.key == "Enter")
          {
            selecteddepart = true;
          }
          else if(e.key != "Enter")
          {
            depart=null;
            selecteddepart = false;
          }
           
      };
}
DepPost("#departments","depart not found","#departmentError","departments","#hidewhere");
DepPost("#parcel_machines","parcel machines not found","#parcel_machineError","postomates","#hidewhere");
DepPost("#streets","street not found","#streetError","streets","#hidewhere");