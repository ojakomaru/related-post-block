import {InspectorControls} from "@wordpress/block-editor";
import {
	PanelBody,
	PanelRow,
	ToggleControl,
	RadioControl,
	TextControl,
} from "@wordpress/components";

export const getInspectorControls = ({attributes, setAttributes}) => {
  return (
		<InspectorControls>
			<PanelBody title="関連記事の設定" initialOpen={true}>
				<PanelRow>
					<TextControl
						className="related-post-id"
						value={attributes.selectedPostId}
						onChange={(val) => setAttributes({ selectedPostId: val })}
						type="number"
						label="投稿・固定ページID"
					/>
				</PanelRow>
			</PanelBody>
			<PanelBody title="表示設定" initialOpen={true}>
				<PanelRow>
					<RadioControl
						className="related-post-design"
						label="表示タイプ（デザイン）"
						selected={attributes.postDesign}
						options={[
							{ label: "シンプル", value: "sinple" },
							{ label: "カード", value: "card" },
						]}
						onChange={(val) => setAttributes({ postDesign: val })}
					/>
				</PanelRow>
				<PanelRow>
					<TextControl
						className="related-label"
						value={attributes.label}
						onChange={(val) => setAttributes({ label: val })}
						type="text"
						label="ラベル："
					/>
				</PanelRow>
				<PanelRow>
					<ToggleControl
						label="日付を表示しない"
						checked={attributes.isTimeStamp}
						onChange={(val) => setAttributes({ isTimeStamp: val })}
					/>
				</PanelRow>
			</PanelBody>
		</InspectorControls>
	);
}