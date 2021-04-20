const { __ } = wp.i18n;
const { useState } = wp.element;
const { TextControl, ToggleControl, ExternalLink, Button } = wp.components;

import Layout from './Layout';

const Dashboard = () => {

    const [ tmdbApi, setTmdbApi ] = useState( '' );
    const [ amazonApi, setAmazonApi ] = useState( '' );
    const [ enableTmdb, setEnableTmdb ] = useState( true );
    const [ enableAmazon, setEnableAmazon ] = useState( true );

    const handleSubmit = ( e ) => {
        e.preventDefault();

        let data = new FormData();

        data.append( 'action', 'submit_form_data' );
        data.append( 'security', eap.nonce );
        data.append( 'tmdbApi', tmdbApi );
        data.append( 'amazonApi', amazonApi );

        let request = new XMLHttpRequest();
        request.open( 'POST', eap.ajax_url );
        request.send( data );
    }

    return(
        <Layout>
            <section className="gridly-general-container">
                <h1 className="gridly-title">{__( 'Dashboard Component', 'gridly' )}</h1>
                <div className="gridly-block-container">
                    <div className="gridly-single-item">
                        TBD
                    </div>
                </div>
            </section>
        </Layout>
    )
}

export default Dashboard;