// Swiper の本体と必要なモジュールをインポート
import Swiper from 'swiper';

// Swiper 11系では 'swiper/css' を使う
import 'swiper/css';


// Swiperを初期化
const swiper = new Swiper('.swiper', {
  modules: [Navigation, Pagination, Scrollbar], // 必要なモジュールを指定
  loop: true, // ループモード

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
