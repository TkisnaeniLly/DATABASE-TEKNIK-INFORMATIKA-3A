const response = require("response");
const Product = require("../../Models/scripts/Catalog/Product");
const Category = require("../../Models/scripts/Catalog/Category");
const Brand = require("../../Models/scripts/Catalog/Brand");
const Media = require("../../Models/scripts/Catalog/Media");
const Variant = require("../../Models/scripts/Catalog/Variant");

const getCatalog = async (req, res) => {
  try {
    const products = await Product.findAll({
      where: { status: "ACTIVE" },
      include: [
        {
          model: Category,
          attributes: ["id", "category_name"],
        },
        {
          model: Brand,
          attributes: ["id", "brand_name"],
        },
        {
          model: Media,
          attributes: ["media_url", "position"],
        },
        {
          model: Variant,
          attributes: ["id", "variant_type", "variant_value", "price"],
        },
      ],
      order: [["created_at", "DESC"]],
    });

    response(res, {
      statusCode: 200,
      message: "Data katalog produk",
      data: products,
    });
  } catch (error) {
    console.error(error);
    response(res, {
      statusCode: 500,
      message: "Internal Server Error",
      data: null,
    });
  }
};

module.exports = getCatalog;
