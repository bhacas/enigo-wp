import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save({
		className: 'py-20 bg-gray-50 w-full',
		id: 'contact',
	});

	const { title, description, contactItems = [], formShortcode } = attributes;

	return (
		<section {...blockProps}>
			<div className="container mx-auto px-4">
				<div className="text-center mb-16">
					<RichText.Content tagName="h2" className="text-3xl md:text-4xl font-bold mt-2 mb-4 text-gray-900" value={title} />
					<RichText.Content tagName="p" className="text-lg text-gray-600 max-w-2xl mx-auto" value={description} />
				</div>
				<div className="grid md:grid-cols-2 gap-12">
					<div>
						{contactItems.map((item, index) => (
							<div key={index} className="flex items-start mb-8">
								{item.icon && <div className="bg-blue-100 p-3 rounded-full mr-4" dangerouslySetInnerHTML={{ __html: item.icon }} />}
								<div>
									{item.headline && <h3 className="font-medium text-gray-900 mb-1">{item.headline}</h3>}
									{item.value && <p className="text-gray-600">{item.value}</p>}
								</div>
							</div>
						))}
					</div>
					<div>
						{/* Zamiast formularza, renderujemy shortcode, który zostanie przetworzony przez WordPress */}
						<div className="contact-form-wrapper">
							{formShortcode}
						</div>
					</div>
				</div>
			</div>
		</section>
	);
}
