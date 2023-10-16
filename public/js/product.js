$(document).ready(function() {
    // Bắt sự kiện khi người dùng nhấn vào nút kích thước
    $('input[type=radio][name=size-choice]').change(function() {
        // Xóa lớp CSS 'active' từ tất cả các nút kích thước
        $('.choose-size label').removeClass('active');

        // Thêm lớp CSS 'active' vào nút kích thước đã chọn
        if ($(this).is(':checked')) {
            console.log($(this).val());
            $(this).closest('.choose-size label').addClass('active');
        }
    });

    $('input[type=radio][name=category-choice]').change(function() {
        // Xóa lớp CSS 'active' từ tất cả các nút kích thước
        $('.choose-category label').removeClass('active');

        // Thêm lớp CSS 'active' vào nút kích thước đã chọn
        if ($(this).is(':checked')) {
            console.log($(this).val());
            $(this).closest('.choose-category label').addClass('active');
        }
    });
});

document.addEventListener( 'DOMContentLoaded', function () {
    var splide = new Splide( '#main-carousel', {
        pagination: false,
      } );


      var thumbnails = document.getElementsByClassName( 'thumbnail' );
      var current;


      for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
      }


      function initThumbnail( thumbnail, index ) {
        thumbnail.addEventListener( 'click', function () {
          splide.go( index );
        } );
      }


      splide.on( 'mounted move', function () {
        var thumbnail = thumbnails[ splide.index ];


        if ( thumbnail ) {
          if ( current ) {
            current.classList.remove( 'is-active' );
          }


          thumbnail.classList.add( 'is-active' );
          current = thumbnail;
        }
      } );


      splide.mount();
  } );

  function decrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value--;
    target.value = value;
  }

  function increment(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value++;
    target.value = value;
  }

  const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
  );

  const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
  );

  decrementButtons.forEach(btn => {
    btn.addEventListener("click", decrement);
  });

  incrementButtons.forEach(btn => {
    btn.addEventListener("click", increment);
  });





