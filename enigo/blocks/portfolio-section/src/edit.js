import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const { title, description, numberOfPosts, buttonText, buttonUrl } = attributes;

	return (
		<>
			{/* Ustawienia w panelu bocznym (inspektorze) */}
			<InspectorControls>
				<PanelBody title={__('Content Settings', 'portfolio-section')}>
					<TextControl
						label={__('Button Text', 'portfolio-section')}
						value={buttonText}
						onChange={(val) => setAttributes({ buttonText: val })}
					/>
					<TextControl
						label={__('Button URL', 'portfolio-section')}
						value={buttonUrl}
						onChange={(val) => setAttributes({ buttonUrl: val })}
					/>
				</PanelBody>
				<PanelBody title={__('Query Settings', 'portfolio-section')}>
					<RangeControl
						label={__('Number of projects to show', 'portfolio-section')}
						value={numberOfPosts}
						onChange={(val) => setAttributes({ numberOfPosts: val })}
						min={1}
						max={9}
					/>
				</PanelBody>
			</InspectorControls>

			{/* Reprezentacja bloku w edytorze */}
			<div {...blockProps}>
				{/* Pola edytowalne bezpośrednio w bloku */}
				<div className="text-center mb-16">
					<RichText
						tagName="h2"
						className="text-3xl md:text-4xl font-bold mb-4 text-gray-900"
						value={title}
						onChange={(newTitle) => setAttributes({ title: newTitle })}
						placeholder={__('Enter section title...', 'portfolio-section')}
					/>
					<RichText
						tagName="p"
						className="text-lg text-gray-600 max-w-2xl mx-auto"
						value={description}
						onChange={(newDesc) => setAttributes({ description: newDesc })}
						placeholder={__('Enter section description...', 'portfolio-section')}
					/>
				</div>

				{/* ServerSideRender pokazuje podgląd na żywo tego, co generuje PHP */}
				<ServerSideRender
					block="create-block/portfolio-section"
					attributes={attributes}
				/>
			</div>
		</>
	);
}
