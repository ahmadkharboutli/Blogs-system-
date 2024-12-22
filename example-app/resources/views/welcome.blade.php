<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>

<body>
    @include('album.index')

</body>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  const descriptions = document.querySelectorAll('#description');
  descriptions.forEach(description => {
      let wordCount = description.innerText.trim().split(/\s+/).length;
      function round(value, precision) {
          var multiplier = Math.pow(10, precision || 0);
          return Math.round(value * multiplier) / multiplier;
      }
      const timeCount = round(wordCount / 200,1);
      description.closest('.card-body').querySelector('#time-count').innerText = `${timeCount} min read`;
  });
});

  
  </script>

</html>