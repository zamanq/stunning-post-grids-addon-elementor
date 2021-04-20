const { render } = wp.element;

import Dashboard from './views/Dashboard.js';

render(
    <Dashboard />,
    document.getElementById('gridly-dashboard')
);