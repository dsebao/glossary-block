import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import './editor.scss';
export default function Edit(props) {
	const {
		attributes: { letter },
		setAttributes,
	} = props;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Glossary item', 'glossary' ) } initialOpen={ true }>
					<PanelRow>
						<TextControl
							id="letter"
							label={__( 'Glossary letter', 'glossary' )}
							value={letter}
							onChange={( letter ) => setAttributes( { letter } )}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<InnerBlocks/>
			</div>
		</>
	);
}
