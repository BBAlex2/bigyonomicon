import * as bootstrap from 'bootstrap';
import axios from 'axios';
import { createPopper } from '@popperjs/core';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// bootstrap auto-init fix (koszi chatgpt C:)
window.Popper = createPopper;
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach((el) => {
      new bootstrap.Dropdown(el);
    });

    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
      new bootstrap.Tooltip(el);
    });

    document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
      new bootstrap.Popover(el);
    });
  });
