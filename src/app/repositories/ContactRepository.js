const prisma = require('../../database');

class ContactRepository {
  async findAll() {
    const result = await prisma.contacts.findMany({
      orderBy: {
        id: 'desc',
      },
    });
    return result;
  }

  async findById(id) {
    const result = await prisma.contacts.findUnique({
      where: { id: parseInt(id) },
    });
    return result;
  }

  async findByEmail(email) {
    const result = await prisma.contacts.findMany({
      where: { email },
      select: { id: true, email: true },
    });
    return result;
  }

  async delete(id) {
    const result = await prisma.contacts.delete({
      where: {
        id: parseInt(id),
      },
    });
    return result;
  }

  async create({
    name, email, phone, category_id,
  }) {
    const result = await prisma.contacts.create({
      data: {
        name,
        email,
        phone,
        categories: { connect: { id: parseInt(category_id) } },
      },
      include: { categories: true },
    });
    return result;
  }

  async update(id, {
    name, email, phone, category_id,
  }) {
    const result = await prisma.contacts.update({
      where: {
        id: parseInt(id),
      },
      data: {
        name,
        email,
        phone,
        categories: { connect: { id: parseInt(category_id) } },
      },
    });
    return result;
  }
}

module.exports = new ContactRepository();
