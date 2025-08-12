import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save({
		className: 'py-20 bg-gray-50 w-full',
		id: 'services',
	});

	const { title, services = [], buttonText, buttonUrl } = attributes;

	return (
		<section {...blockProps}>
			<div className="container mx-auto px-4">
				<div className="text-center mb-16">
					<RichText.Content
						tagName="h2"
						className="text-3xl md:text-4xl font-bold mb-4 text-gray-900"
						value={title}
					/>
				</div>

				{services.length > 0 && (
					<div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
						{services.map((service, index) => (
							<div key={index} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:translate-y-[-5px]">
								{service.icon && (
									<div className="text-blue-600 mb-4" dangerouslySetInnerHTML={{ __html: service.icon }} />
								)}
								{service.headline && (
									<h3 className="text-xl font-semibold mb-3 text-gray-900">{service.headline}</h3>
								)}
								{service.description && (
									<p className="text-gray-600">{service.description}</p>
								)}
							</div>
						))}
					</div>
				)}

				{buttonText && buttonUrl && (
					<div className="text-center">
						<a href={buttonUrl}>
							<button className="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700">{buttonText}</button>
						</a>
					</div>
				)}
			</div>
		</section>
	);
}
