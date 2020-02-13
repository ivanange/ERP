<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharma</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body style="width: 100vw; height:100vh">
    <div id="app"  class="custom-scroll w-100 h-100 d-flex flex-column overflow-auto" style="max-height: 100%;">
        <Navbar></Navbar>
        <router-view name="sideBar" :list="searchResult" :categoryid="categoryid"></router-view>
        <router-view>  </router-view>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
