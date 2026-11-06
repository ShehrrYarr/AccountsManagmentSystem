// Constants for attribute names and default values

const ATTRIBUTES = {
  MAIN_LAYOUT: 'data-main-layout',
  THEME: 'data-bs-theme',
  THEME_COLOR: 'data-theme-color',
  DIRECTION_MODE: 'dir',
  SIDEBAR: 'data-sidebar',
  NAV_POSITION: 'data-nav-position',
  NAV_TYPE: 'data-nav-type',
  FONT_HEADING: 'data-font-heading',
  FONT_BODY: 'data-font-body',
  FONT_SIZE: 'data-font-size',
  LAYOUT_ROUNDED: 'data-layout-rounded',
  PAGE_LOADER: 'data-page-loader',
  AUTH_LAYOUT: 'AUTH_LAYOUT',
};

const DEFAULT_VALUES = {
  [ATTRIBUTES.MAIN_LAYOUT]: 'two-column', // 'vertical', 'horizontal', 'two-column' , 'semi-boxed', 'compact, 'small-icon', 'close-sidebar'
  [ATTRIBUTES.THEME]: 'light', // 'light', 'dark', 'auto'
  [ATTRIBUTES.THEME_COLOR]: 'primary', // 'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'blue', 'purple', 'pink', 'orange', 'teal'
  [ATTRIBUTES.DIRECTION_MODE]: 'ltr', // 'ltr', 'rtl'
  [ATTRIBUTES.SIDEBAR]: 'light-sidebar', // 'light-sidebar', 'dark-sidebar', 'gradient-sidebar'
  [ATTRIBUTES.NAV_POSITION]: 'sticky', // 'sticky', 'static', 'hidden'
  [ATTRIBUTES.NAV_TYPE]: 'default', // 'default', 'dark', 'glass'
  [ATTRIBUTES.FONT_HEADING]: 'Poppins', // 'Inter', 'Poppins', 'Roboto', 'Open Sans', 'Lato'
  [ATTRIBUTES.FONT_BODY]: 'Inter', // 'Inter', 'Poppins', 'Roboto', 'Open Sans', 'Lato'
  [ATTRIBUTES.FONT_SIZE]: 'md', // 'sm', 'md', 'lg'
  [ATTRIBUTES.LAYOUT_ROUNDED]: 'md', // 'xs', 'sm', 'md', 'lg', 'xl'
  [ATTRIBUTES.PAGE_LOADER]: 'visible', // 'hidden', 'visible'
  [ATTRIBUTES.AUTH_LAYOUT]: typeof AUTH_LAYOUT === 'undefined' ? false : AUTH_LAYOUT,
};

const THEME_MODES = {
  LIGHT: 'light',
  DARK: 'dark',
  SYSTEM: 'auto',
};
