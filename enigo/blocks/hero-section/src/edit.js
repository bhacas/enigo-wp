import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps({
		className: 'w-full bg-gradient-to-r from-blue-50 to-blue-100 py-20 md:py-32',
	});

	const { buttons = [] } = attributes;

	const handleAddButton = () => {
		const newButtons = [...buttons, { text: 'New Button', url: '#', style: 'primary' }];
		setAttributes({ buttons: newButtons });
	};

	const handleRemoveButton = (index) => {
		const newButtons = buttons.filter((_, i) => i !== index);
		setAttributes({ buttons: newButtons });
	};

	const handleButtonChange = (index, key, value) => {
		const newButtons = [...buttons];
		newButtons[index][key] = value;
		setAttributes({ buttons: newButtons });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Buttons Repeater', 'hero-section')}>
					{buttons.map((button, index) => (
						<div key={index} style={{ marginBottom: '1em', paddingBottom: '1em', borderBottom: '1px solid #ccc' }}>
							<p><strong>Button #{index + 1}</strong></p>
							<TextControl
								label={__('Button Text', 'hero-section')}
								value={button.text}
								onChange={(val) => handleButtonChange(index, 'text', val)}
							/>
							<TextControl
								label={__('Button URL', 'hero-section')}
								value={button.url}
								onChange={(val) => handleButtonChange(index, 'url', val)}
							/>
							{/* NOWY ELEMENT: Wybór stylu przycisku */}
							<SelectControl
								label={__('Button Style', 'hero-section')}
								value={button.style}
								options={[
									{ label: 'Primary (Blue)', value: 'primary' },
									{ label: 'Secondary (Border)', value: 'secondary' },
								]}
								onChange={(val) => handleButtonChange(index, 'style', val)}
							/>
							<Button isDestructive onClick={() => handleRemoveButton(index)}>
								{__('Remove Button', 'hero-section')}
							</Button>
						</div>
					))}
					<Button variant="primary" onClick={handleAddButton}>
						{__('Add Button', 'hero-section')}
					</Button>
				</PanelBody>
			</InspectorControls>

			{/* Wizualna reprezentacja bloku w edytorze */}
			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<div className="max-w-3xl mx-auto text-center">
						<RichText
							tagName="h1"
							className="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6"
							value={attributes.headline}
							onChange={(newHeadline) => setAttributes({ headline: newHeadline })}
							placeholder={__('Enter your headline here...', 'hero-section')}
						/>
						<RichText
							tagName="p"
							className="text-lg md:text-xl text-gray-700 mb-10"
							value={attributes.description}
							onChange={(newDescription) => setAttributes({ description: newDescription })}
							placeholder={__('Enter your description here...', 'hero-section')}
						/>
						<div className="flex flex-col sm:flex-row justify-center gap-4">
							{buttons.map((button, index) => (
								<button key={index} className="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700 flex items-center justify-center">
									{button.text}
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-arrow-right ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
								</button>
							))}
						</div>
					</div>
				</div>
			</section>
		</>
	);
}
