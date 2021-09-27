<div class="controlbar--sticky flex justify-between">
  <div class="margin-xs">
    <div class="inline-flex items-baseline">
      <h1 class="text-md color-contrast-high margin-x-xs" for="filterItems">Edit Templatename</h1>
    </div>
  </div>

  <!-- Menu Bar -->
  <div class="flex flex-wrap items-center justify-between margin-right-xxs">
    <div class="flex flex-wrap">
    <div class="flex flex-wrap">

      <li class="menu-bar__item js-menu-bar" aria-controls="modal-add-article">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="#9b9b9b"><path fill="#9b9b9b" d="M13.02 0.81v4.15h4.15z"></path><path fill="#9b9b9b" d="M17.67 8.99v-3.41h-4.96c-0.19 0-0.31-0.12-0.31-0.31v-4.96h-9.92c-0.19 0-0.31 0.12-0.31 0.31v8.37h15.5z"></path><path fill="#9b9b9b" d="M2.17 17.36v1.86c0 0.19 0.12 0.31 0.31 0.31h14.88c0.19 0 0.31-0.12 0.31-0.31v-1.86h-15.5z"></path><path fill="#9b9b9b" d="M18.91 9.61h-17.98c-0.19 0-0.31 0.12-0.31 0.31v6.51c0 0.19 0.12 0.31 0.31 0.31h17.98c0.19 0 0.31-0.12 0.31-0.31v-6.51c0-0.19-0.12-0.31-0.31-0.31z m-12.15 4.96h-0.62v-1.24h-1.15v1.24h-0.62v-2.88h0.62v1.11h1.15v-1.11h0.62v2.88z m2.69-2.36h-0.77v2.36h-0.62v-2.36h-0.77v-0.49h2.17v0.49z m3.63 2.36h-0.56v-1.36-0.22c0-0.09 0-0.31 0.04-0.68h-0.04l-0.74 2.26h-0.56l-0.68-2.26h-0.03c0.03 0.46 0.03 0.78 0.03 0.93v1.33h-0.56v-2.88h0.84l0.68 2.2 0.71-2.2h0.84v2.88z m2.58 0h-1.77v-2.88h0.62v2.38h1.18v0.5z"></path></g></svg>
        <span class="menu-bar__label">HTML</span>
      </li>

      <li class="menu-bar__item padding-top-xxxs">
        <a href="{{ url('admin/posts/settings') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="#9b9b9b"><path fill="#9b9b9b" d="M2.1 18.06v1.26a0.42 0.42 0 0 0 0.42 0.42h15.12a0.42 0.42 0 0 0 0.42-0.42v-1.26h-15.96z"></path><path fill="#9b9b9b" d="M18.06 8.82v-2.94h-5.04a0.42 0.42 0 0 1-0.42-0.42v-5.04h-10.08a0.42 0.42 0 0 0-0.42 0.42v7.98h15.96z"></path><path fill="#9b9b9b" d="M13.44 1.09v3.95h3.95z"></path><path fill="#9b9b9b" d="M13.33 12.54h-0.23v0.76h0.16c0.13 0 0.24-0.04 0.32-0.11 0.08-0.08 0.12-0.18 0.12-0.31 0-0.22-0.12-0.33-0.37-0.34z"></path><path fill="#9b9b9b" d="M6.87 12.54h-0.23v0.76h0.16c0.13 0 0.24-0.04 0.32-0.11 0.08-0.08 0.12-0.18 0.12-0.31 0-0.22-0.12-0.33-0.37-0.34z"></path><path fill="#9b9b9b" d="M19.32 9.66h-18.48a0.42 0.42 0 0 0-0.42 0.42v6.72a0.42 0.42 0 0 0 0.42 0.42h18.48a0.42 0.42 0 0 0 0.42-0.42v-6.72a0.42 0.42 0 0 0-0.42-0.42z m-11.51 4.06c-0.22 0.2-0.53 0.3-0.92 0.31h-0.25v1.09h-0.89v-3.3h1.14c0.42 0 0.73 0.09 0.94 0.27 0.21 0.18 0.31 0.44 0.31 0.78 0 0.37-0.11 0.65-0.33 0.85z m3.68 1.4h-0.89v-1.34h-1.04v1.34h-0.89v-3.3h0.89v1.22h1.04v-1.22h0.89v3.3z m2.78-1.4c-0.22 0.2-0.53 0.3-0.92 0.31h-0.25v1.09h-0.89v-3.3h1.14c0.42 0 0.73 0.09 0.94 0.27 0.21 0.18 0.31 0.44 0.31 0.78 0 0.37-0.11 0.65-0.33 0.85z"></path></g></svg>
        </a>
        <span class="menu-bar__label">PHP</span>
      </li>

      <li class="menu-bar__item" aria-controls="edit-modal">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="#9b9b9b"><path d="M17.32 11.17a6.9 6.9 0 0 0 0-2.42l1.75-1.68a0.83 0.83 0 0 0 0.14-1.01l-1.25-2.16a0.84 0.84 0 0 0-0.95-0.38l-2.32 0.66a7.48 7.48 0 0 0-2.1-1.2l-0.58-2.35a0.83 0.83 0 0 0-0.8-0.63h-2.49a0.83 0.83 0 0 0-0.81 0.63l-0.59 2.35a7.49 7.49 0 0 0-2.09 1.2l-2.32-0.66a0.84 0.84 0 0 0-0.95 0.38l-1.25 2.16a0.83 0.83 0 0 0 0.14 1.01l1.75 1.68a7.62 7.62 0 0 0-0.11 1.21 7.53 7.53 0 0 0 0.11 1.21l-1.75 1.68a0.83 0.83 0 0 0-0.14 1.01l1.25 2.16a0.83 0.83 0 0 0 0.72 0.41 0.85 0.85 0 0 0 0.22-0.03l2.33-0.66a7.49 7.49 0 0 0 2.1 1.2l0.58 2.35a0.83 0.83 0 0 0 0.81 0.63h2.49a0.83 0.83 0 0 0 0.8-0.63l0.59-2.35a7.49 7.49 0 0 0 2.09-1.2l2.33 0.66a0.85 0.85 0 0 0 0.22 0.03 0.83 0.83 0 0 0 0.72-0.41l1.25-2.16a0.83 0.83 0 0 0-0.14-1.01z m-6.53 0.3v1.81h-1.66v-1.81a2.49 2.49 0 1 1 1.66 0z" fill="#9b9b9b"></path></g></svg>
        <span class="menu-bar__label">Settings</span>
      </li>

      <li class="menu-bar__item" aria-controls="modal-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g stroke-width="2" fill="#9b9b9b"><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M10.08 1.89a8.19 8.19 0 1 0 0 16.38 8.19 8.19 0 1 0 0-16.38z"></path><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M10.08 0.63v3.15"></path><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M19.53 10.08h-3.15"></path><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M10.08 19.53v-3.15"></path><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M0.63 10.08h3.15"></path><path fill="none" stroke="#9b9b9b" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M10.08 8.19a1.89 1.89 0 1 0 0 3.78 1.89 1.89 0 1 0 0-3.78z"></path></g></svg>
        <span class="menu-bar__label">Preview</span>
      </li>

      <li class="menu-bar__item" aria-controls="modal-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">><g fill="#9b9b9b"><path fill="#9b9b9b" d="M16.25 8.88v-0.13c0-3.5-2.75-6.25-6.25-6.25-3.13 0-5.75 2.25-6.13 5.38-2.25 0.75-3.87 2.75-3.87 5.25 0 3.13 2.5 5.63 5.63 5.62h9.37c2.75 0 5-2.25 5-5 0-2.38-1.63-4.25-3.75-4.88z m-5 3.62v3.75h-2.5v-3.75h-3.75l5-5 5 5h-3.75z"></path></g></svg>
        <span class="menu-bar__label">Save</span>
      </li>

      <li class="menu-bar__item" aria-controls="modal-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="#9b9b9b"><path d="M18.48 2.94h-5.16l-0.74-2.23a0.42 0.42 0 0 0-0.4-0.29h-4.2a0.42 0.42 0 0 0-0.4 0.29l-0.74 2.23h-5.16a0.42 0.42 0 0 0-0.42 0.42v1.26a0.42 0.42 0 0 0 0.42 0.42h16.8a0.42 0.42 0 0 0 0.42-0.42v-1.26a0.42 0.42 0 0 0-0.42-0.42z"></path><path d="M16.8 5.88h-13.44v11.76a2.1 2.1 0 0 0 2.1 2.1h9.24a2.1 2.1 0 0 0 2.1-2.1z m-9.66 10.08a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z" fill="#9b9b9b"></path></g></svg>
        <span class="menu-bar__label">Delete</span>
      </li>

      <li class="menu-bar__item js-menu-bar margin-left-lg" aria-controls="create-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g><path fill="#223E49" d="M3.44 18.56l-0.5-1.34-1.34-0.5-0.46 2.3z"></path><path fill="#EAD8C5" d="M6.09 18.03l-1.05-3.03-2.91-0.93-0.53 2.65 1.84 1.84z"></path><path fill="#335262" d="M14.53 1.68l-2.23 2.22 1.56 2.4 2.4 1.56 2.22-2.23a0.84 0.84 0 0 0 0-1.18l-2.77-2.77a0.84 0.84 0 0 0-1.18 0z"></path><path fill="#E86C60" d="M2.13 14.07l10.17-10.17 2.4 2.4-10.17 10.17z"></path><path fill="#DD5E58" d="M4.11 16.05l10.17-10.17 1.98 1.98-10.17 10.17z"></path><path fill="#E6E6E6" d="M12.01 4.2l0.59-0.59 3.95 3.95-0.59 0.59z"></path></g></svg>
        <span class="menu-bar__label">Create Template</span>
      </li>

    </div>
  </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
</div>
