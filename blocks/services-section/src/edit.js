import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps({
		className: 'py-20 bg-gray-50 w-full',
	});

	const { title, services = [], buttonText, buttonUrl } = attributes;

	const handleAddService = () => {
		const newServices = [...services, { icon: '', headline: 'New Service', description: 'New description.' }];
		setAttributes({ services: newServices });
	};

	const handleRemoveService = (index) => {
		const newServices = services.filter((_, i) => i !== index);
		setAttributes({ services: newServices });
	};

	const handleServiceChange = (index, key, value) => {
		const newServices = [...services];
		newServices[index][key] = value;
		setAttributes({ services: newServices });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Main Button', 'services-section')}>
					<TextControl
						label={__('Button Text', 'services-section')}
						value={buttonText}
						onChange={(val) => setAttributes({ buttonText: val })}
					/>
					<TextControl
						label={__('Button URL', 'services-section')}
						value={buttonUrl}
						onChange={(val) => setAttributes({ buttonUrl: val })}
					/>
				</PanelBody>
				<PanelBody title={__('Service Items', 'services-section')}>
					{services.map((service, index) => (
						<div key={index} style={{ marginBottom: '1em', paddingBottom: '1em', borderBottom: '1px solid #ccc' }}>
							<p><strong>Service #{index + 1}</strong></p>
							<TextareaControl
								label={__('SVG Icon Code', 'services-section')}
								value={service.icon}
								onChange={(val) => handleServiceChange(index, 'icon', val)}
								help={__('Paste the full <svg> code here.', 'services-section')}
								rows="3"
							/>
							<TextControl
								label={__('Headline', 'services-section')}
								value={service.headline}
								onChange={(val) => handleServiceChange(index, 'headline', val)}
							/>
							<TextareaControl
								label={__('Description', 'services-section')}
								value={service.description}
								onChange={(val) => handleServiceChange(index, 'description', val)}
							/>
							<Button isDestructive onClick={() => handleRemoveService(index)}>
								{__('Remove Service', 'services-section')}
							</Button>
						</div>
					))}
					<Button variant="primary" onClick={handleAddService}>
						{__('Add Service', 'services-section')}
					</Button>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="text-center mb-16">
						<RichText
							tagName="h2"
							className="text-3xl md:text-4xl font-bold mb-4 text-gray-900"
							value={title}
							onChange={(newTitle) => setAttributes({ title: newTitle })}
							placeholder={__('Enter section title...', 'services-section')}
						/>
					</div>
					<div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
						{services.map((service, index) => (
							<div key={index} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
								<div className="text-blue-600 mb-4" dangerouslySetInnerHTML={{ __html: service.icon }} />
								<h3 className="text-xl font-semibold mb-3 text-gray-900">{service.headline}</h3>
								<p className="text-gray-600">{service.description}</p>
							</div>
						))}
					</div>
					<div className="text-center">
						<button className="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700">{buttonText}</button>
					</div>
				</div>
			</section>
		</>
	);
}
