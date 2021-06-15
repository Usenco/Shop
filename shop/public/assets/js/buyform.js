
class Posht
{
    constructor(type) {
        this.setType(type);
        this.settings = 
        {
            "In_department" : "nova_poshta meest_express justin delivery",
            "By_courier" : "nova_poshta meest_express",
            "By_parcel_machine" : "nova_poshta",
            "pickup" : "pickup"
        };
    }

    setType(type)
    {
        this.type = type;
    }
    getType()
    {
        return this.type;
    }
    set_settings()
    {
        $("#type_of_delivery").find("li").hide();
        for (let key_element in this.settings) {
            for (let split_element of this.settings[key_element].split(" ")) {
                if(split_element==this.type)
                {
                    console.log("#"+key_element);
                    $("#"+key_element).show();
                }
            }
            
        }
    }
}

let list_buttons = $('.selected-item');

function getRotationDegrees(obj) {
    let matrix = obj.css("-webkit-transform") ||
    obj.css("-moz-transform")    ||
    obj.css("-ms-transform")     ||
    obj.css("-o-transform")      ||
    obj.css("transform");
    let angle = 0;
    if(matrix !== 'none') {
      let values = matrix.split('(')[1].split(')')[0].split(',');
      let a = values[0];
      let b = values[1];
      angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
    } else {angle = 0; }
    return (angle < 0) ? angle +=360 : angle;
  }

function close_items(event)
{
    $(this).off('click',close_items);
    $(document).off('click',close_document_items);
    $(this).on('click',drop_items);

    $(this).find("~ul").slideUp(300);
    rotation(179,1,-3,$(this));
    
    event.stopPropagation();
}

function drop_items(event)
{
    close_document_items();

    $(this).off('click',drop_items);
    $(this).on('click',close_items);
    $(document).on('click',close_document_items);
    
    $(this).find("~ul").slideDown(300);

    rotation(1,1,3,$(this));

    event.stopPropagation();
}

function close_document_items()
{

    for (let element of list_buttons) {
        if (getRotationDegrees($(element).find("p")) >= 179 ) {
            rotation(179,1,-3,$(element)); 
            $(element).find("~ul").slideUp(300);
        }
    }
    $(list_buttons).off('click',close_items);
    $(list_buttons).off('click',drop_items);
    $(this).off('click',close_document_items);

    list_buttons.on('click',drop_items);
}

function rotation(angle,interval,speed,rotater)
{
    let obj = rotater;
    let rotate = setInterval(()=>{
            obj.find("p").css(
                {"transform": "rotate(-"+angle+"deg)"}
                )
            if(angle >= 180)
            {
                clearInterval(rotate);
            }
            angle+=speed;
            if(angle <=0)angle=360;
        },
    interval);
}


function press_li()
{
    let i = 0;
    for (let element of $(this).parent().find("li")) {
        if($(this).index()===$(element).index())break;
        i++
    }
    $($(this).parent().parent().find(".number_of_selected_item")[0]).attr("value",i);
    $($(this).parent().parent().find(".number_of_selected_item")[0]).trigger("change");
    

}

function set_selected_item()
{
    let drop_element = $(this).parent();
    let selected_item = $(this).attr("value");
    let i = 0;
    for (let item of $(drop_element).find("ul li")) {
        if(i == selected_item)
        {
            item = $(item);
            show_li_block(item.data("li_block"));
            if(item.find("img") != null) $(drop_element).find(".selected-item div img").attr("src",item.find("img").attr("src"));
            if(item.find("h2") != null) $(drop_element).find(".selected-item div h2").html(item.find("h2").html());
            if(item.data("li_block") != null){
                let posht = new Posht(item.data("li_block"));
                posht.set_settings();
            }
            break;
        }

        i++;
        
    }
}

function show_li_block(li_block)
{
    for(let element of $(".drop-list ul li"))
    {
        if(li_block === $(element).data("li_block"))$(element).show();
    }
}

list_buttons.on('click',drop_items);

$($(".number_of_selected_item")).change(set_selected_item);

$(".drop-list ul li").on("click",press_li);

$(".number_of_selected_item").trigger("change");
