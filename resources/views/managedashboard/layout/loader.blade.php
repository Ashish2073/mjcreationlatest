<style>
    @keyframes loader-element {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    .loader-element div {
        position: absolute;
        width: 120px;
        height: 120px;
        border: 20px solid #125e81;
        border-top-color: transparent;
        border-radius: 50%;
    }

    .loader-element div {
        animation: loader-element 1s linear infinite;
        top: 100px;
        left: 100px;
    }

    .demo {
        -webkit-filter: blur(5px) grayscale(100%);
        pointer-events: none;
    }

    .loader-element {
        transform: translateZ(0) scale(1);
        backface-visibility: hidden;
        transform-origin: 0 0;

        z-index: 999999 !important;
        position: absolute;
        top: 25vh;
        left: 43vw;
    }
</style>

<div class="container-div">
    <div class="loader-element" id="loader">

    </div>
</div>
