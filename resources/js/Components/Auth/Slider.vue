<script setup>
import { ref, onUnmounted } from 'vue';

const images = [
    {
        // src: 'https://petapixel.com/assets/uploads/2022/12/what-is-unsplash-800x420.jpg',
        src:  '../../../images/6.jpg',
        alt: 'Image 1',
    },
    {
        // src: 'https://petapixel.com/assets/uploads/2022/12/image13-1-800x536.jpg',
        src:  '../../../images/7.jpg',
        alt: 'Image 2',
    },
    {
        // src: 'https://petapixel.com/assets/uploads/2022/12/image11-1-800x534.jpg',
        src:  '../../../images/8.jpg',
        alt: 'Image 3',
    },
];

const currentSliderIndex = ref(0);
let intervalId;

const isTimerPaused = ref(false);

const nextSlide = () => {
    currentSliderIndex.value = (currentSliderIndex.value + 1) % images.length;
    isTimerPaused ? '' : startSlider()
};

const prevSlide = () => {
    currentSliderIndex.value = (currentSliderIndex.value - 1 + images.length) % images.length;
    isTimerPaused ? '' : startSlider()
};

const startSlider = () => {
    intervalId = setInterval(() => {
        nextSlide();
    }, 10000);
};

const playSlider = () => {
    isTimerPaused.value = false;
    startSlider();
}

const stopSlider = () => {
    clearInterval(intervalId);
    isTimerPaused.value = true;
}

startSlider();

onUnmounted(() => {
    clearInterval(intervalId);
});
</script>

<template>
    <template v-for="(image, index) in images" :key="index">
        <transition name="fade" >
            <img :src="image.src" :alt="image.alt" style="height:925px; width:1500px" class="aspect-[16/9] absolute" v-show="index === currentSliderIndex" />
        </transition>
    </template>

</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s, transform 1s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateX(0);
}
</style>
