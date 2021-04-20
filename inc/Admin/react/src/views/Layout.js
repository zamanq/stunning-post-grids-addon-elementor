const { Fragment } = wp.element;

import Navbar from '../components/Navbar';

const Layout = ({ children }) => {
    return (
        <Fragment>
            <Navbar />
            { children }
        </Fragment>
    )
}

export default Layout;