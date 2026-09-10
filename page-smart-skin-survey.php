<?php get_header(); ?>

<section class="survey-hero">
    <div class="container">
        <span class="eyebrow">Skin Assessment</span>
        <h1 class="stroke-heading">Smart Skin Survey</h1>
        <p>Tell us a little about your skin so we can recommend the right treatments for you. It only takes a couple of minutes.</p>
    </div>
</section>

<section class="survey-embed container">
    <div class="survey-embed-panel">
        <!-- <iframe data-tally-src="https://tally.so/r/44lRNb?transparentBackground=1" loading="lazy" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="Smart Skin Survey"></iframe> -->
        <iframe data-tally-src="https://tally.so/embed/Me4lGA?alignLeft=1&hideTitle=1&transparentBackground=1&dynamicHeight=1" loading="lazy" width="100%" height="4110" frameborder="0" marginheight="0" marginwidth="0" title="Smart Skin Survey "></iframe>
    </div>
<script>var d=document,w="https://tally.so/widgets/embed.js",v=function(){"undefined"!=typeof Tally?Tally.loadEmbeds():d.querySelectorAll("iframe[data-tally-src]:not([src])").forEach((function(e){e.src=e.dataset.tallySrc}))};if("undefined"!=typeof Tally)v();else if(d.querySelector('script[src="'+w+'"]')==null){var s=d.createElement("script");s.src=w,s.onload=v,s.onerror=v,d.body.appendChild(s);}</script>
</section>

<script async src="https://tally.so/widgets/embed.js"></script>

<?php get_footer(); ?>
