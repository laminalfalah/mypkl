<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <style media="screen">
      body { background-color: #fff; }
      .container { margin: 0px; padding: 0px; background-color: #f6f6f6;}
      .header { margin: 0px; }
      .header > .kotak { border: 1px solid #dddaff; padding: 5px; background-color: #dddaff; }
      .header > .kotak > .text-center { margin: 10px; text-align: center; }
      .header > .kotak > .text-center a { font-size: 26px; color: #7a7a7a; text-decoration: none;}
      .header > .kotak > .text-center a:hover { color: #474747; cursor: pointer;}
      .body { margin: 25px 50px; letter-spacing: 1.2px; line-height: 2; padding: 1px 15px; }
      .body > .line { margin-bottom: 10px; text-align: justify; }
      .body > .action { margin-bottom: 10px; text-align: center; }
      .body > .action > a {
        text-decoration: none; font-size: 1rem; border-radius: .25rem; margin-bottom: 10px;
        color: #fff; background-color: #0275d8; border-color: #0275d8;  display: inline-block;
        font-weight: 400; line-height: 1.25; white-space: nowrap; vertical-align: middle;
        border: 1px solid transparent; padding: .5rem 1rem; transition: all .2s ease-in-out;
      }
      .body > .trouble { border-top: 1px solid #0275d8; padding-top: 10px; }
      .body > .trouble a { font-size: 1rem; color: #0275d8;}
      .footer { margin: 0px; }
      .footer > .kotak { border: 1px solid #dddaff; padding: 5px; background-color: #dddaff; }
      .footer > .kotak > .text-center { margin: 10px; text-align: center; font-size: 16px; color: #7a7a7a; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <div class="kotak">
          <div class="text-center">
            <a href="{{ config('app.url', 'http://wwww.sakoholidays.com')}}">
              {{ config('app.name', 'Sako Holidays') }}
            </a>
          </div>
        </div>
      </div>
      @yield('content')
      <div class="footer">
        <div class="kotak">
          <div class="text-center">
            &copy; &nbsp;{{ date('Y') }} &nbsp;{{ config('app.name', 'Sako Holidays') }}. All rights reserved.
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
