<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Practice 1 - Vue Data viewer</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
      <div class="container">
          <div class="panel">
            <div id="app" class="panel-body">
                <data-viewer source="api/customer" title="Customer Data" />
            </div>
          </div>
      </div>
  </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
