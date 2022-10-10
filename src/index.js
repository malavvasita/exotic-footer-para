import { SelectControl, PanelBody } from '@wordpress/components'
import { InspectorControls, RichText } from "@wordpress/block-editor";
import { Fragment } from "@wordpress/element";

wp.blocks.registerBlockType(
    'exotic/footer-para',
    {
        title: "Footer Comprehension",
        icon: "format-aside",
        category: "common",
        attributes: {
            content: {
                type: 'string'
            },
            scheme: {
                type: 'string',
                default: 'exotic-scheme-1'
            }
        },
        edit: function( props ) {
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title="Settings" initialOpen={true}>
                            <SelectControl
                                label="Select Scheme"
                                value={ props.attributes.scheme }
                                options={ [
                                    { label: 'Scheme 1', value: 'exotic-scheme-1' },
                                    { label: 'Scheme 2', value: 'exotic-scheme-2' }
                                ] }
                                onChange={ (value) => props.setAttributes({ scheme: value }) }
                            />
                        </PanelBody>
                    </InspectorControls>
                    <RichText
                        tagName="p"
                        className={ props.attributes.scheme }
                        value={props.attributes.content}
                        onChange={ (newVal) => props.setAttributes({content: newVal}) }
                    />
                </Fragment>
            );
        },
        save: function( props ) {
            return null
        }
    }
);