<!DOCTYPE html>
<html lang="$ContentLocale">
  <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> – $SiteConfig.Title</title>
  <meta charset="UTF-8">
  <meta name="description" content="$MetaDescription">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/css/main.css">
<body class="$ClassName">
<% include Header %>
<% include Nav %>
<main>
  <header>
    <h2>$PageHeading</h2>    
  </header>
  $Layout
</main>
<% include Footer %>
<p>Breadcrumbs: <textarea>$Breadcrumbs</textarea></p>
<p>ClassName: <textarea>$ClassName</textarea></p>
<p>Title: <textarea>$Title</textarea></p>
<p>MenuTitle: <textarea>$MenuTitle</textarea></p>
<p>MetaTitle: <textarea>$MetaTitle</textarea></p>