import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps({
		className: 'py-20 bg-white w-full',
	});

	const { title, description, missionTitle, missionDescription, techTitle, technologies = [] } = attributes;

	const handleAddTech = () => {
		const newTechs = [...technologies, 'New Tech'];
		setAttributes({ technologies: newTechs });
	};

	const handleRemoveTech = (index) => {
		const newTechs = technologies.filter((_, i) => i !== index);
		setAttributes({ technologies: newTechs });
	};

	const handleTechChange = (index, value) => {
		const newTechs = [...technologies];
		newTechs[index] = value;
		setAttributes({ technologies: newTechs });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Technologies List', 'about-section')}>
					{technologies.map((tech, index) => (
						<div key={index} style={{ display: 'flex', alignItems: 'center', marginBottom: '8px' }}>
							<TextControl
								value={tech}
								onChange={(val) => handleTechChange(index, val)}
							/>
							<Button isDestructive isSmall onClick={() => handleRemoveTech(index)} style={{ marginLeft: '8px' }}>
								X
							</Button>
						</div>
					))}
					<Button variant="primary" onClick={handleAddTech}>
						{__('Add Technology', 'about-section')}
					</Button>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="text-center mb-16">
						<RichText
							tagName="h2"
							className="text-3xl md:text-4xl font-bold mt-2 mb-4 text-gray-900"
							value={title}
							onChange={(val) => setAttributes({ title: val })}
							placeholder={__('Who we are', 'about-section')}
						/>
						<RichText
							tagName="p"
							className="text-lg text-gray-600 max-w-2xl mx-auto"
							value={description}
							onChange={(val) => setAttributes({ description: val })}
							placeholder={__('We are a team of tech enthusiasts...', 'about-section')}
						/>
					</div>
					<div className="grid md:grid-cols-2 gap-12 items-center">
						<div>
							<RichText
								tagName="h3"
								className="text-2xl font-bold mb-4 text-gray-900 mission-title"
								value={missionTitle}
								onChange={(val) => setAttributes({ missionTitle: val })}
								placeholder={__('Our mission', 'about-section')}
							/>
							<RichText
								tagName="p"
								className="text-gray-600 mb-6 mission-description"
								value={missionDescription}
								onChange={(val) => setAttributes({ missionDescription: val })}
								placeholder={__('To create tools that not only look great...', 'about-section')}
							/>
						</div>
						<div>
							<RichText
								tagName="h3"
								className="text-2xl font-bold mb-4 text-gray-900 tech-title"
								value={techTitle}
								onChange={(val) => setAttributes({ techTitle: val })}
								placeholder={__('Technologies we use:', 'about-section')}
							/>
							<div className="flex flex-wrap gap-2">
								{technologies.map((tech, index) => (
									<span key={index} className="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">{tech}</span>
								))}
							</div>
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
