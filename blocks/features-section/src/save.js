import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save({
		className: 'py-20 bg-white w-full',
	});

	const { title, features = [] } = attributes;

	return (
		<section {...blockProps}>
			<div className="container mx-auto px-4">
				<RichText.Content
					tagName="h2"
					className="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900"
					value={title}
				/>

				{features.length > 0 && (
					<div className="grid md:grid-cols-3 gap-8">
						{features.map((feature, index) => (
							<div key={index} className="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
								{/* Używamy dangerouslySetInnerHTML do renderowania kodu SVG. Jest to bezpieczne, ponieważ kod jest wprowadzany przez zaufanego użytkownika w panelu admina. */}
								{feature.icon && (
									<div className="text-blue-600 mb-4" dangerouslySetInnerHTML={{ __html: feature.icon }} />
								)}
								{feature.headline && (
									<h3 className="text-xl font-semibold mb-3 text-gray-900">{feature.headline}</h3>
								)}
								{feature.description && (
									<p className="text-gray-600">{feature.description}</p>
								)}
							</div>
						))}
					</div>
				)}
			</div>
		</section>
	);
}
