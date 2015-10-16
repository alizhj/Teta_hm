var $ = jQuery;
var counter, pos, element, cloneId, price;

$(document).ready(function(){
    filteringCategories();  

    // $('#clothes').on('click', '.nav-links a', function(e) {
    //  e.preventDefault();
    //  console.log('clicked link');

    //  var link = $(this).attr('href');
    //  $('#clothes').fadeOut(300, function() {
    //      $(this).load(link + ' #clothes', function() {
    //          $(this).fadeIn(300);
    //      });
    //  });
    // });

    // Functionality of slider
    $('.cover').on('click', function() {
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    dragImg();
});

/**
* Function that shows the posts that belongs to the link clicked and hide the rest
*/
function filteringCategories() {
    $('.menu ul li a').on('click', function() {
        itemName = $(this).attr('id');
        console.log(itemName);

        $('#clothes div').each(function() {
            if($(this).hasClass(itemName)) {
                $(this).show();
                //console.log($(this));
            } else {
                $(this).hide();
            }
        });
    });
}

/**
* Function of Drag&Drop 
* Makes post-thumbnail draggable and makes a clone of it
* The clone is then droppable in content #bed
* Gets the clones price stored in attr data-price and makes a li with same id of clone
* Shows .details img that stores colors/sizes when clone is clicked
* Makes the clone and price from li disapear when dropped in #bin
*/
function dragImg(){
    //Counter
    counter = 0;
    //Make element draggable
    $('.wp-post-image').draggable({
        helper:'clone',
        containment: '#bed',

        //When first dragged
        stop:function(ev, ui) {
            var pos = $(ui.helper).offset();
            objName = '#clonediv'+counter;
            $(objName).removeClass('wp-post-image');

            //When an existing object is dragged
            $(objName).draggable({
                containment: 'parent',
                stop: function(ev, ui) {
                    var pos = $(ui.helper).offset();
                }
            });
        }
    }).css('position','absolute');

    //Make element droppable
    $('#bed').droppable({
        drop: function(ev, ui) {
            if (ui.draggable.attr('id').search(/drag[0-9]/) != -1){
                counter++;
                var pos = $(ui.helper).offset();
                var element = $(ui.draggable).clone();
                //element.addClass("tempclass");
                $(this).append(element);
                $(element).attr('id','clonediv'+counter);
                //$("#clonediv"+counter).removeClass("tempclass");

                //Get the dynamically item id
                draggedNumber = ui.draggable.attr('id').search(/drag([0-9])/)
                itemDragged = 'dragged' + RegExp.$1

                $("#clonediv"+counter).addClass(itemDragged);
                removeText();               

                // Store the price of the clone item and the clones id in variables and appends it in #ShoppingList li
                price = ($('#bed #clonediv'+counter).attr('data-price'));
                cloneId = $('#clonediv'+counter).attr('id');
                $('#shoppingList ul').append('<li class="'+cloneId+'">Pris: '+price+':-</li>');

                // Shows popup with details
                $('#bed img').on('click', function() {
                    $('.details').fadeIn(500);
                });
                unloadDetails();
            }
        }
    });
    //Make element and price disapear
    $('#bin').droppable({
        drop: function(event, ui) {
            item = $(ui.draggable).attr('id');
            //console.log(item);
            $('#shoppingList ul li').each(function() {
                if( $('#shoppingList ul li').hasClass(item) ){
                    $('#shoppingList ul .'+item).remove();
                } 
            });
            unloadDetails();
            //console.log('bin');
            ui.draggable.remove();
        }
    });
}

/**
* Function to make details disapear
*/
function unloadDetails() {
    $('.details').fadeOut(500);
}

/**
* Function to make details disapear
*/
function removeText() {
    $('#bed p').fadeOut('fast');
}