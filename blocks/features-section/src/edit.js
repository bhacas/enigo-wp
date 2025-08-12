import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps({
		className: 'py-20 bg-white w-full',
	});

	const { title, features = [] } = attributes;

	const handleAddFeature = () => {
		const newFeatures = [...features, { icon: '', headline: 'New Headline', description: 'New description.' }];
		setAttributes({ features: newFeatures });
	};

	const handleRemoveFeature = (index) => {
		const newFeatures = features.filter((_, i) => i !== index);
		setAttributes({ features: newFeatures });
	};

	const handleFeatureChange = (index, key, value) => {
		const newFeatures = [...features];
		newFeatures[index][key] = value;
		setAttributes({ features: newFeatures });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Feature Items', 'features-section')}>
					{features.map((feature, index) => (
						<div key={index} style={{ marginBottom: '1em', paddingBottom: '1em', borderBottom: '1px solid #ccc' }}>
							<p><strong>Feature #{index + 1}</strong></p>
							<TextareaControl
								label={__('SVG Icon Code', 'features-section')}
								value={feature.icon}
								onChange={(val) => handleFeatureChange(index, 'icon', val)}
								help={__('Paste the full <svg> code here.', 'features-section')}
							/>
							<TextControl
								label={__('Headline', 'features-section')}
								value={feature.headline}
								onChange={(val) => handleFeatureChange(index, 'headline', val)}
							/>
							<TextareaControl
								label={__('Description', 'features-section')}
								value={feature.description}
								onChange={(val) => handleFeatureChange(index, 'description', val)}
							/>
							<Button isDestructive onClick={() => handleRemoveFeature(index)}>
								{__('Remove Feature', 'features-section')}
							</Button>
						</div>
					))}
					<Button variant="primary" onClick={handleAddFeature}>
						{__('Add Feature', 'features-section')}
					</Button>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<RichText
						tagName="h2"
						className="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900"
						value={title}
						onChange={(newTitle) => setAttributes({ title: newTitle })}
						placeholder={__('Enter section title...', 'features-section')}
					/>
					<div className="grid md:grid-cols-3 gap-8">
						{/* Wizualizacja w edytorze */}
						{features.map((feature, index) => (
							<div key={index} className="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
								<div className="text-blue-600 mb-4" dangerouslySetInnerHTML={{ __html: feature.icon }} />
								<h3 className="text-xl font-semibold mb-3 text-gray-900">{feature.headline}</h3>
								<p className="text-gray-600">{feature.description}</p>
							</div>
						))}
					</div>
				</div>
			</section>
		</>
	);
}
