# Restrict access plugin for October CMS

Restrict access to pages using the [passage plugin](https://github.com/firemankurt/passage). If the currently logged in user doesn't have the required rights, he will be redirected to "&/".   

## Usage

Add the component to any of your page and select the required access permission in the october backend.

Example:

```
[restrictAccess]
permission = "someRequiredPermission"
```

If you want to use this component on static pages via the [static pages plugin](https://github.com/rainlab/pages-plugin), this plugin provides a snippet which performs redirects.

Example:
```html
<figure data-component="Jhendess\RestrictAccess\Components\RestrictAccess"
  data-inspector-class="Jhendess\RestrictAccess\Components\RestrictAccess"
  data-property-permission="access_verein"
  data-snippet="restrictAccess">
   &nbsp;
</figure>

```
  