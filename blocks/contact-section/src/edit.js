import {InspectorControls, RichText, useBlockProps} from '@wordpress/block-editor';
import {Button, PanelBody, TextareaControl, TextControl} from '@wordpress/components';
import {__} from '@wordpress/i18n';

export default function Edit({attributes, setAttributes}) {
	const blockProps = useBlockProps({
		className: 'py-20 bg-gray-50 w-full',
	});

	const {title, description, contactItems = [], formShortcode} = attributes;

	const handleAddItem = () => {
		const newItems = [...contactItems, {icon: '', headline: 'New Headline', value: 'New Value'}];
		setAttributes({contactItems: newItems});
	};

	const handleRemoveItem = (index) => {
		const newItems = contactItems.filter((_, i) => i !== index);
		setAttributes({contactItems: newItems});
	};

	const handleItemChange = (index, key, value) => {
		const newItems = [...contactItems];
		newItems[index][key] = value;
		setAttributes({contactItems: newItems});
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Contact Form', 'contact-section')}>
					<TextareaControl
						label={__('Form Shortcode', 'contact-section')}
						value={formShortcode}
						onChange={(val) => setAttributes({formShortcode: val})}
						help={__('Install a form plugin (e.g., Contact Form 7) and paste the shortcode here.', 'contact-section')}
					/>
				</PanelBody>
				<PanelBody title={__('Contact Items', 'contact-section')}>
					{contactItems.map((item, index) => (
						<div key={index}
							 style={{marginBottom: '1em', paddingBottom: '1em', borderBottom: '1px solid #ccc'}}>
							<p><strong>Item #{index + 1}</strong></p>
							<TextareaControl label={__('SVG Icon Code', 'contact-section')} value={item.icon}
											 onChange={(val) => handleItemChange(index, 'icon', val)} rows="2"/>
							<TextControl label={__('Headline', 'contact-section')} value={item.headline}
										 onChange={(val) => handleItemChange(index, 'headline', val)}/>
							<TextControl label={__('Value', 'contact-section')} value={item.value}
										 onChange={(val) => handleItemChange(index, 'value', val)}/>
							<Button isDestructive onClick={() => handleRemoveItem(index)}>
								{__('Remove Item', 'contact-section')}
							</Button>
						</div>
					))}
					<Button variant="primary" onClick={handleAddItem}>
						{__('Add Item', 'contact-section')}
					</Button>
				</PanelBody>
			</InspectorControls>

			<div className="text-center mb-16">
				<RichText tagName="h2" className="text-3xl md:text-4xl font-bold mt-2 mb-4 text-gray-900" value={title}
						  onChange={(val) => setAttributes({title: val})}
						  placeholder={__('Get in touch', 'contact-section')}/>
				<RichText tagName="p" className="text-lg text-gray-600 max-w-2xl mx-auto" value={description}
						  onChange={(val) => setAttributes({description: val})}
						  placeholder={__('Got a question or a project in mind?', 'contact-section')}/>
			</div>
			<div className="grid md:grid-cols-2 gap-12">
				<div>
					{contactItems.map((item, index) => (
						<div key={index} className="flex items-start mb-8">
							<div className="bg-blue-100 p-3 rounded-full mr-4"
								 dangerouslySetInnerHTML={{__html: item.icon}}/>
							<div>
								<h3 className="font-medium text-gray-900 mb-1">{item.headline}</h3>
								<p className="text-gray-600">{item.value}</p>
							</div>
						</div>
					))}
				</div>
				<div className="bg-white p-8 rounded-xl shadow-sm">
					<p className="text-gray-500">[Form shortcode will be rendered here on the live site]</p>
					<p className="text-gray-500 mt-2"><strong>Shortcode:</strong> {formShortcode}</p>
				</div>
			</div>
		</>
	);
}
