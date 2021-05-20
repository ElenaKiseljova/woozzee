
const cardImageClickHandler = function (target, mainImg) {
    let targetSourceSrcset = target.srcset;
    let mainSourceSrcset = mainImg.srcset;
    let targetSourceSrc = target.src;
    let mainSourceSrc = mainImg.src;
    
    if (targetSourceSrcset && mainSourceSrcset) {
        target.srcset = mainSourceSrcset;
        mainImg.srcset = targetSourceSrcset;
    }

    target.src = mainSourceSrc;
    mainImg.src = targetSourceSrc;
};

const cardClickHandler = function (e) {
    if (window.innerWidth >= 768 && window.innerWidth < 1200) {
        e.preventDefault();
        e.stopPropagation();
        Array.from(this.children).forEach((it) => {
            if (it.tagName !== 'A') {
                it.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }
        });

        $('.good-article--popup').removeClass('good-article--popup');
        this.classList.add('good-article--popup');

        this.addEventListener('click', function (e) {
            e.stopPropagation();
        });
        document.addEventListener('click', function(e) {
            el.classList.remove('good-article--popup');
        });

        const el = this;
        document.addEventListener('keyup', function(e) {
            if (e.key === 'Esc' || e.key === 'Escape') {
                el.classList.remove('good-article--popup');
                el.addEventListener('click', cardClickHandler);
                document.removeEventListener('keyup', this);
            }
        })
        this.querySelector('.good-article__close').addEventListener('click', function(e) {
            e.stopPropagation();
            el.classList.remove('good-article--popup');
            el.addEventListener('click', cardClickHandler);
        });
    }
};

const videoInit = function ($) {
    let isPlaying = false;
    const video = $('.video-section video')[0];
    $('.video-section__button').click(function(e) {
        if (!isPlaying) {
            video.play();
            isPlaying = true;
        } else {
            video.pause();
            isPlaying = false;
        }
        this.classList.toggle('video-section__button--pause');
    });
};

const tabsHandler = () => {
    const tabsButtons = document.querySelectorAll('.tabs-section__item');
    const tabs = document.querySelectorAll('.tabs-section__goods-list');

    if (window.innerWidth >= 768) {

        Array.from(tabsButtons).forEach((it, i) => {
            it.querySelector('A').addEventListener( 'click',function(e) {
                e.preventDefault();
    
                Array.from(tabsButtons).forEach((b) => b.classList.remove('tabs-section__item--current'));
                it.classList.add('tabs-section__item--current');
    
                Array.from(tabs).forEach((tab, ind) => {
                    tab.classList.add('tabs-section__goods-list--hidden');
    
                    if (ind === i) {
                        tab.classList.remove('tabs-section__goods-list--hidden');
                    }
                });
            });
        });
    } else {
        Array.from(tabsButtons).forEach((it, i) => {
            it.querySelector('A').addEventListener( 'click',function(e) {
                e.preventDefault();
    
                it.parentNode.classList.toggle('tabs-section__tabs-list--open-mobile');
 
                Array.from(tabsButtons).forEach((button, index) => {
                    button.addEventListener('click', function(evt) {
                        Array.from(tabsButtons).forEach((b) => b.classList.remove('tabs-section__item--current'));
                        button.classList.add('tabs-section__item--current');
                        button.removeEventListener('click', this);

                        Array.from(tabs).forEach((tab, ind) => {
                            tab.classList.add('tabs-section__goods-list--hidden');
            
                            if (ind === index) {
                                tab.classList.remove('tabs-section__goods-list--hidden');
                            }
                        });
                    });
                });
            });
        });
    }
};

jQuery(document).ready(($) => {
    
    const headerElement = document.querySelector('.page-header');
    const toggleMenuButtonElement = headerElement.querySelector('.page-header__menu-button');
    const logoElement = headerElement.querySelector('.header-logo');
    const navElement = headerElement.querySelector('.header-nav');
    
    const toggleMenuHandler = function (e) {
        e.stopPropagation();
        headerElement.classList.toggle('page-header--mobile-menu');
        toggleMenuButtonElement.classList.toggle('page-header__menu-button--closed');
        logoElement.classList.toggle('header-logo--visible');
        navElement.classList.toggle('header-nav--visible');        
    };
    
    toggleMenuButtonElement.addEventListener('click', toggleMenuHandler);

    $('.about-us__text-toggler').click(() => {
        $('.about-us__text').toggleClass('about-us__text--shown');
    });

    

    const catalogArticleHeight = $('.catalog-article__text').innerHeight()

    if (catalogArticleHeight > 200) {
        $('.catalog-article__text').css('height', '200px');
        $('.catalog-article__button').click((e) => {
            if ($('.catalog-article__text').css('height') === '200px') {
                $('.catalog-article__text').css('height', `${catalogArticleHeight}px`);
            } else {
                $('.catalog-article__text').css('height', '200px');
            }
            
        });
    } else {
        $('.catalog-article__button').css('display', 'none')
    }



    $('.callback-form__input').inputmask({"mask": "+7 (999) 999 99 99"});
    $('.contact-section__input--phone').inputmask({"mask": "+7 (999) 999 99 99"});

    $('.catalog-section__button-element').click((e) => {
        const target = e.target.closest('.catalog-section__button');
        target.classList.toggle('catalog-section__button--opened');
        target.classList.toggle('catalog-section__button--closed');
    });

    $('.header-nav__item--sublist > a').click((e) => {
        if (window.innerWidth < 1024) {

            e.stopPropagation();
            e.preventDefault();
            const link = e.target;
            const list = link.closest('.header-nav__item--sublist');
            
            list.classList.toggle('header-nav__item--mobile-sublist');    
        }
    });
    $('.nav-sublist__item--arrow > a').click((e) => {
        if (window.innerWidth < 1024) { 

            e.stopPropagation();
            e.preventDefault();
            const link = e.target;
            const list = link.closest('.nav-sublist__item');
            
            list.classList.toggle('nav-sublist__item--mobile-sublist');    
        }
    });
    $('.catalog-section__item--arrow > a').click((e) => {
        e.stopPropagation();
        e.preventDefault();
        const link = e.target;
        const list = link.closest('.catalog-section__item--sublist');
        
        list.classList.toggle('catalog-section__item--shown');    
    });

    // $(window).scroll((e) => {
    //     if (e.currentTarget.scrollY > 0) {
    //         if (!$('.page-header').hasClass('page-header--sticky')) {
    //             $('.page-header').addClass('page-header--sticky');
    //         }
    //     } else {
    //         if ($('.page-header').hasClass('page-header--sticky')) {
    //             $('.page-header').removeClass('page-header--sticky');
    //         }
    //     }
    // })

    $('.good-article').click(cardClickHandler);
    $('.good-article').each(function( i, el){
        if (!el.querySelector('.good-article__img-list')) {
            el.style.top = '-35px';
            el.style.left = '-30px';
            el.style.minWidth = 'unset';
        }
    });
    

    $('.good-article__img-list img').click(function(e) {
        if (window.innerWidth >= 768) {
            const mainImg = e.target.closest('.good-article').querySelector('.good-article__img-wrapper').querySelector('IMG');
            
            cardImageClickHandler(e.target, mainImg);
        }
    });

    $('.good-article__info-wrapper button ').click((e) => e.stopPropagation());
    $('.good-article__info-wrapper .good-article__price ').click((e) => e.stopPropagation());
    $('.good-article__info-wrapper .good-article__title ').click((e) => e.stopPropagation());

    
    
    

    videoInit($);

    tabsHandler();
    
    const catalogSwiper = new Swiper('.slider-section__slider-container', {
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
          },
    });
    const catalogSwiper1 = new Swiper('.goods-card__img-wrapper--1', {
        spaceBetween: 20,
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
          },
        breakpoints: {
            320: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 30,
            },
            425: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 50,
            }
        }
    });
    const catalogSwiper2 = new Swiper('.goods-card__img-wrapper--2', {
        spaceBetween: 20,
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
          },
          breakpoints: {
            320: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 30,
            },
            425: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 50,
            }
        }
    });
    const catalogSwiper3 = new Swiper('.goods-card__img-wrapper--3', {
        spaceBetween: 20,
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
          },
          breakpoints: {
            320: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 30,
            },
            425: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 50,
            }
        }
    });
    const catalogSwiper4 = new Swiper('.goods-card__img-wrapper--4', {
        spaceBetween: 20,
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
          },
          breakpoints: {
            320: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 30,
            },
            425: {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 50,
            }
        }
    });
    
    const bannerSwiper = new Swiper('.banner-section__container', {
        breakpoints: {
            320: {
                centeredSlides: true,
                slidesPerView: 'auto',
            },
            1024: {
                pagination: {
                    clickable: true,
                    el: '.swiper-pagination',
                    },
            },
        }
    });

    if (document.querySelector('MAIN').classList.contains('page-main--product')) {
        const productImgSlider = new Swiper('.product__img-list', {
            
            breakpoints: {
                320: {
                    slidesPerView: 4,
                    spaceBetween: 20, 
                },
                768: {
                    direction: 'vertical',
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    spaceBetween: 15,
                    direction: 'vertical',
                    slidesPerView: 3,
                },
                1200: {
                    direction: 'horizontal',
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });

        $('.product__img-list img').click(function(e) {
            const mainImg = e.target.closest('.product__img-section').querySelector('.product__main-img').querySelector('IMG');
            
            cardImageClickHandler(e.target, mainImg);
        });
    }
});
