<?php

namespace App\Test\Controller;

use App\Entity\ExperienciLaboral;
use App\Repository\ExperienciLaboralRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExperienciLaboralControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ExperienciLaboralRepository $repository;
    private string $path = '/experienci/laboral/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(ExperienciLaboral::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ExperienciLaboral index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'experienci_laboral[nombreempresa]' => 'Testing',
            'experienci_laboral[puesto]' => 'Testing',
            'experienci_laboral[descripcion]' => 'Testing',
            'experienci_laboral[fechainicio]' => 'Testing',
            'experienci_laboral[fechafin]' => 'Testing',
        ]);

        self::assertResponseRedirects('/experienci/laboral/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ExperienciLaboral();
        $fixture->setNombreempresa('My Title');
        $fixture->setPuesto('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setFechainicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ExperienciLaboral');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ExperienciLaboral();
        $fixture->setNombreempresa('My Title');
        $fixture->setPuesto('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setFechainicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'experienci_laboral[nombreempresa]' => 'Something New',
            'experienci_laboral[puesto]' => 'Something New',
            'experienci_laboral[descripcion]' => 'Something New',
            'experienci_laboral[fechainicio]' => 'Something New',
            'experienci_laboral[fechafin]' => 'Something New',
        ]);

        self::assertResponseRedirects('/experienci/laboral/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombreempresa());
        self::assertSame('Something New', $fixture[0]->getPuesto());
        self::assertSame('Something New', $fixture[0]->getDescripcion());
        self::assertSame('Something New', $fixture[0]->getFechainicio());
        self::assertSame('Something New', $fixture[0]->getFechafin());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ExperienciLaboral();
        $fixture->setNombreempresa('My Title');
        $fixture->setPuesto('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setFechainicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/experienci/laboral/');
    }
}
