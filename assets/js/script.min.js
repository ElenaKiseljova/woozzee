
const cardImageClickHandler = function (target, mainImg) {
    let targetSource = target.src
    let mainSource = mainImg.src

    target.src = mainSource
    mainImg.src = targetSource
    
}

const cardClickHandler = function (e) {
    if (window.innerWidth >= 768 && window.innerWidth < 1200) {
        e.preventDefault()
        e.stopPropagation()
        Array.from(this.children).forEach((it) => {
            if (it.tagName !== 'A') {
                it.addEventListener('click', (e) => {
                    e.stopPropagation()
                })
            }
        })

        $('.good-article--popup').removeClass('good-article--popup')
        this.classList.add('good-article--popup')

        this.addEventListener('click', function (e) {
            e.stopPropagation()
        });
        document.addEventListener('click', function(e) {
            el.classList.remove('good-article--popup')
        })

        const el = this;
        document.addEventListener('keyup', function(e) {
            if (e.key === 'Esc' || e.key === 'Escape') {
                el.classList.remove('good-article--popup')
                el.addEventListener('click', cardClickHandler)
                document.removeEventListener('keyup', this)
            }
        })
        this.querySelector('.good-article__close').addEventListener('click', function(e) {
            e.stopPropagation()
            el.classList.remove('good-article--popup')
            el.addEventListener('click', cardClickHandler)
        })
    }
};

const videoInit = function ($) {
    let isPlaying = false;
    const video = $('.video-section video')[0]
    $('.video-section__button').click(function(e) {
        if (!isPlaying) {
            video.play()
            isPlaying = true
        } else {
            video.pause()
            isPlaying = false
        }
        this.classList.toggle('video-section__button--pause')
    })
}

const tabsHandler = () => {
    const tabsButtons = document.querySelectorAll('.tabs-section__item')
    const tabs = document.querySelectorAll('.tabs-section__goods-list')

    Array.from(tabsButtons).forEach((it, i) => {
        it.querySelector('A').addEventListener( 'click',function(e) {
            e.preventDefault()

            Array.from(tabsButtons).forEach((b) => b.classList.remove('tabs-section__item--current'))
            it.classList.add('tabs-section__item--current')

            Array.from(tabs).forEach((tab, ind) => {
                tab.classList.add('tabs-section__goods-list--hidden')

                if (ind === i) {
                    tab.classList.remove('tabs-section__goods-list--hidden')
                }
            })
        })
    })
}

jQuery(document).ready(($) => {
    const headerElement = document.querySelector('.page-header');
    const toggleMenuButtonElement = headerElement.querySelector('.page-header__menu-button');
    const logoElement = headerElement.querySelector('.header-logo');
    const navElement = headerElement.querySelector('.header-nav');
    
    const toggleMenuHandler = function (e) {
        e.stopPropagation()
        headerElement.classList.toggle('page-header--mobile-menu');
        toggleMenuButtonElement.classList.toggle('page-header__menu-button--closed');
        logoElement.classList.toggle('header-logo--visible');
        navElement.classList.toggle('header-nav--visible');

        if ($(headerElement).hasClass('page-header--mobile-menu')) {

            headerElement.addEventListener('click', toggleMenuHandler)
        } else {
            headerElement.removeEventListener('click', toggleMenuHandler)
        }

        
    }
    
    toggleMenuButtonElement.addEventListener('click', toggleMenuHandler);

    $('.about-us__text-toggler').click(() => {
        $('.about-us__text').toggleClass('about-us__text--shown')
    })
    $('.catalog-article__button').click(() => {
        $('.catalog-article__text').toggleClass('catalog-article__text--shown')
    })

    $('.callback-form__input').inputmask({"mask": "+7 (999) 999 99 99"})

    $('.catalog-section__button').click((e) => {
        const target = e.target.closest('button')
        target.classList.toggle('catalog-section__button--opened')
        target.classList.toggle('catalog-section__button--closed')
    })

    $('.header-nav__item--sublist a').click((e) => {
        e.stopPropagation()
        e.target.closest('.header-nav__item--sublist').classList.toggle('header-nav__item--mobile-sublist')
        document.addEventListener('click', function(ev) {
            e.target.closest('.header-nav__item--sublist').classList.remove('header-nav__item--mobile-sublist')
            document.removeEventListener('click', this)
        })
    
    })

    $(window).scroll((e) => {
        if (e.currentTarget.scrollY > 0) {
            if (!$('.page-header').hasClass('page-header--sticky')) {
                $('.page-header').addClass('page-header--sticky')
            }
        } else {
            if ($('.page-header').hasClass('page-header--sticky')) {
                $('.page-header').removeClass('page-header--sticky')
            }
        }
    })

    $('.good-article').click(cardClickHandler)

    $('.good-article__img-list img').click(function(e) {
        if (window.innerWidth >= 768) {
            const mainImg = e.target.closest('.good-article').querySelector('.good-article__img-wrapper').querySelector('IMG');
            
            cardImageClickHandler(e.target, mainImg)
        }
    })

    $('.good-article__info-wrapper button ').click((e) => e.stopPropagation())
    $('.good-article__info-wrapper a ').click((e) => e.stopPropagation())


    videoInit($)

    tabsHandler()
})

const catalogSwiper = new Swiper('.slider-section__slider-container', {
    pagination: {
        el: '.swiper-pagination',
      },
})
const catalogSwiper1 = new Swiper('.goods-card__img-wrapper--1', {
    spaceBetween: 20,
    pagination: {
        el: '.swiper-pagination',
      },
})
const catalogSwiper2 = new Swiper('.goods-card__img-wrapper--2', {
    spaceBetween: 20,
    pagination: {
        el: '.swiper-pagination',
      },
})
const catalogSwiper3 = new Swiper('.goods-card__img-wrapper--3', {
    spaceBetween: 20,
    pagination: {
        el: '.swiper-pagination',
      },
})
const catalogSwiper4 = new Swiper('.goods-card__img-wrapper--4', {
    spaceBetween: 20,
    pagination: {
        el: '.swiper-pagination',
      },
})

if (window.screen.availWidth > 1023) {
    const bannerSwiper = new Swiper('.banner-section__container', {
        pagination: {
            el: '.swiper-pagination',
          },
    })
}