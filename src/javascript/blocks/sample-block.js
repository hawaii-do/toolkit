import { registerBlockType } from "@wordpress/blocks";
import { RichText } from "@wordpress/block-editor";

registerBlockType("toolkit/sample-block", {
    title: "Sample Block",
    icon: "feedback",
    category: "common",
    attributes: {
        content: {
            type: "string"
        }
    },
    example: {
        attributes: {
            content: "From Hawaii with Love"
        }
    },
    edit: props => {
        const {
            attributes: { content },
            setAttributes
        } = props;
        return (
            <div className="block-shapper">
                <h1>Aloha Hawaii !</h1>
                <RichText
                    tagName="p"
                    onChange={content => setAttributes({ content: content })}
                    value={content}
                    placeholder={"Ajoutez une description"}
                />
            </div>
        );
    },
    save: props => {
        return (
            <div className="block-shapper">
                <h1>Aloha Hawaii !</h1>
                <RichText.Content tagName="p" value={content} />
            </div>
        );
    }
});
