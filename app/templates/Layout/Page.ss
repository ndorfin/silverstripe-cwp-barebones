<% if $ElementalArea %>
    <% if $ElementalArea.RichLinks %>
        $ElementalArea.RichLinks
    <% else %>
        $ElementalArea
    <% end_if %>
<% else %>
    $Content
<% end_if %>
<% if $Children %>
<aside>
    <% include SidebarNav %>
</aside>
<% end_if %>
