jQuery(document).ready(function($) {
    /*-----menu-----*/
    $('.item-head-main').on('click', function(e) {
        $('.item-head-main').removeClass('menu-item-active');
        $(this).addClass('menu-item-active');
    });
    /*-----menu end-----*/
    /*-----input-search-----*/
    $('.search__input').focusin(function(event) {
        $('.search__icon').css('background-image', 'none');

    });
    $('.search__input').focusout(function(event) {
        $('.search__icon').css('background-image', "url('img/search_icon.png')");

    });
    /*-----input-search end-----*/
    /*-----accordeon-----*/
    $('.content-section__title').click(function(event) {

        if ($(this).hasClass('panel-open')) {
            $(this).removeClass('panel-open');
            $(this).next('.content-section__info').slideUp();
        } else {
            $(this).addClass('panel-open');
            $(this).next('.content-section__info').slideDown();
        }
    });
    /*-----accordeon end-----*/

    /*-----profile-popup-----*/
    $('.profile__dropdown').on('click', function(event) {
        event.preventDefault();
        $('.profile__popup').show();
        $(document).mouseup(function(e) {
            var block = $(".profile__popup");
            if (!block.is(e.target) &&
                block.has(e.target).length === 0) {
                block.hide();
            }
        });
    });
    /*-----profile-popup end-----*/
    /*-----popup-----*/
    $('.add-new').on('click', function(e) {
        $('.overlay').fadeIn();
        $('.popup-add').fadeIn();
    });
    $('#add-type').on('click', function(e) {
        $('.overlay').fadeIn();
        $('.popup-add-type').fadeIn();
    });
    $('#add-agency').on('click', function(e) {
        $('.overlay').fadeIn();
        $('.popup-add-agency').fadeIn();
    });

    $('.popup__close').on('click', function(e) {
        $('.overlay').fadeOut();
        $('.popup-add').fadeOut();
        $('.popup-add-type').fadeOut();
        $('.popup-add-agency').fadeOut();
        $('.popup-edit').fadeOut();
        $('.popup-del').fadeOut();

    });

    $('.edit').on('click', function(e) {
        $('.overlay').fadeIn();
        $('.popup-edit').fadeIn();

    });
    $('.del').on('click', function(e) {
        $('.overlay').fadeIn();
        $('.popup-del').fadeIn();

    });
    $('.buttons__cancel').on('click', function(e) {
        $('.overlay').fadeOut();
        $('.popup-del').fadeOut();

    });
    /*-----popup end-----*/
    /*-----amount-hover-----*/
    $('.amount-number').hover(function() {
        $(this).prev('.amount-line').css('background-color', 'transparent');
        $(this).next('.amount-line').css('background-color', 'transparent');
    }, function() {
        $(this).prev('.amount-line').css('background-color', '#373d42');
        $(this).next('.amount-line').css('background-color', '#373d42');
    });
    //table edit-del
    $('tr').hover(function() {
        $(this).find('.edit').css('display', 'inline-block');
        $(this).find('.del').css('display', 'inline-block');
    }, function() {
        $(this).find('.edit').css('display', 'none');
        $(this).find('.del').css('display', 'none');
    });
    /*-----amount-hover end-----*/
    /*-----ui input date-----*/
    $('.add-date').datepicker({ dateFormat: "dd.mm.yy" }).datepicker("setDate", new Date());;
    /*-----ui input date end-----*/
    /*----form-styler-----*/
    $('td>input').styler();
    $('select').styler({
        locale: 'en'
    });
    $('#subscribe-inp').styler();
    /*----form-styler end-----*/
    /*----- steps change-----*/
    $('#select-type-styler').change(function(event) {
        $('.step1').addClass('active');
    });
    $('#select-city-styler').change(function(event) {
        $('.step2').addClass('active');
    });
    $('#customer-form').change(function(event) {
        var inpList = $(this).find('input');
        var arr = [];

        $(inpList).each(function(index, el) {
            if (el.value != "") { arr.push(el.value) }
        });

        if (arr.length === 5) {
            $('.step3').addClass('active'); 
        }
        console.log(arr);

    });

    /*----- steps change end-----*/
});