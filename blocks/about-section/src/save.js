import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save({
		className: 'py-20 bg-white w-full',
		id: 'about',
	});

	const { title, description, missionTitle, missionDescription, techTitle, technologies = [] } = attributes;

	return (
		<section {...blockProps}>
			<div className="container mx-auto px-4">
				<div className="text-center mb-16">
					<RichText.Content
						tagName="h2"
						className="text-3xl md:text-4xl font-bold mt-2 mb-4 text-gray-900"
						value={title}
					/>
					<RichText.Content
						tagName="p"
						className="text-lg text-gray-600 max-w-2xl mx-auto"
						value={description}
					/>
				</div>
				<div className="grid md:grid-cols-2 gap-12 items-center">
					<div>
						<RichText.Content
							tagName="h3"
							className="text-2xl font-bold mb-4 text-gray-900 mission-title"
							value={missionTitle}
						/>
						<RichText.Content
							tagName="p"
							className="text-gray-600 mb-6 mission-description"
							value={missionDescription}
						/>
					</div>
					<div>
						<RichText.Content
							tagName="h3"
							className="text-2xl font-bold mb-4 text-gray-900 tech-title"
							value={techTitle}
						/>
						{technologies.length > 0 && (
							<div className="flex flex-wrap gap-2">
								{technologies.map((tech, index) => (
									<span key={index} className="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">{tech}</span>
								))}
							</div>
						)}
					</div>
				</div>
			</div>
		</section>
	);
}
