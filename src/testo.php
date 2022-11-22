<!DOCTYPE html>
<html>
  <head>
    <script src="https://cdn.jwplayer.com/libraries/dwKoZnZe.js"></script>
    <meta charset="utf-8" />
    <title>ELTESTO</title>

    <!--

  Uses the latest versions of video.js and videojs-http-streaming.

  To use specific versions, please change the URLs to the form:

  <link href="https://unpkg.com/video.js@6.7.1/dist/video-js.css" rel="stylesheet">
  <script src="https://unpkg.com/video.js@6.7.1/dist/video.js"></script>
  <script src="https://unpkg.com/@videojs/http-streaming@0.9.0/dist/videojs-http-streaming.js"></script>

  -->

    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet" />
  </head>
  <body>
    <h1>Video.js Example Embed</h1>

    <video-js id="my_video_1" class="vjs-default-skin" controls preload="auto" width="640" height="268">
      <source src="https://www.youtube.com/watch?v=nA9UZF-SZoQ" type="application/x-mpegURL" />
    </video-js>

    <!-- <iframe width="480" height="270" src="https://ustream.tv/embed/17074538" scrolling="no" allowfullscreen webkitallowfullscreen frameborder="0" style="border: 0 none transparent"></iframe> -->
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>
    <script>
      var player = videojs("my_video_1");
    </script>
  </body>
</html>